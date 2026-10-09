<?php

namespace App\Services;

use App\Repositories\OrderRepository;
use App\Repositories\ProductRepository;
use App\Repositories\ProductVariantRepository;
use App\Services\Interfaces\OrderServiceInterface;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Mail\OrderMail;
use App\Mail\OrderMailFail;
use App\Models\Attribute;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Mail;

/**
 * interface  UserService
 * @package App\Services
 */

class OrderService implements OrderServiceInterface
{
    protected $orderRepository;
    protected $productRepository;
    protected $productVariantRepository;
    protected $cartService;

    public function __construct(
        ProductRepository $productRepository,
        ProductVariantRepository $productVariantRepository,
        OrderRepository $orderRepository,
        CartService $cartService,
    ) {
        $this->orderRepository = $orderRepository;
        $this->productRepository = $productRepository;
        $this->productVariantRepository = $productVariantRepository;
        $this->cartService = $cartService;
    }

    public function all()
    {
        return $this->orderRepository->all(
            ['orderItems', 'orderItems.productVariants', 'orderItems.products'],
            [
                ['customer_id', Auth::id()],
            ]
        );
    }

    public function paginate($request)
    {
        $condition = [
            'keyword' => addslashes($request->input('keyword')),
            'publish' => $request->input('publish') !== null ? $request->integer('publish') : null,
            'where' => [
                ['status', '=',  $request->input('status')],
                ['payment', '=',  $request->input('payment')]
            ]
        ];
        $condition['created_at'] = $request->input('created_at');
        $relation = ['orderItems', ['orderItems.products'], 'orderItems.productVariants'];
        $perPage = $request->integer('perpage') ?: 10;
        $orders = $this->orderRepository->pagination(
            $this->paginateSelect(),
            $condition,
            $relation,
            ['id', 'DESC'],
            $perPage,
        );

        return $orders;
    }



    // tạo đơn hàng user Fontend
    public function create($request)
    {
        DB::beginTransaction();
        try {
            $payload = $this->preparePayload($request);
            $order = $this->orderRepository->create($payload);
            if ($order->id > 0) {
                $orderItem = $this->createOrderitems($request, $order);
            }
            DB::commit();
            return $order;
        } catch (\Exception $e) {
            DB::rollBack();
            echo $e->getMessage();
            return false;
        }
    }

    public function sendMail($order)
    {
        $order = $this->all();
        $to = $order->email;
        $cc = 'beecloudy2024@gmail.com'; // gửi về mail của hệ thống 
        $content = ['order' => $order];
        Mail::to($to)->cc($cc)->send(new OrderMail($content));
    }
    public function sendMailFail($order)
    {
        $order = $this->all();
        $to = $order->email;
        $cc = 'beecloudy2024@gmail.com'; // gửi về mail của hệ thống 
        $content_fail = ['order' => $order];
        Mail::to($to)->cc($cc)->send(new OrderMailFail($content_fail));
    }


    private function preparePayload($request)
    {
        $payload = $request->except(['_token', 'submit']);
        $payload['code'] = Str::upper(Str::random(2, 'ABCDEFGHIJKLMNOPQRSTUVWXYZ')) . time();
        $payload['customer_id'] = Auth::id();
        $payload['address'] = $payload['address'] . ', ' . $payload['ward_name'] . ', ' . $payload['district_name'] . ', ' . $payload['province_name'];
        $payload['cart'] = json_encode($this->cartService->all());
        $payload['total_items'] = $this->cartService->countProductIncart();
        return $payload;
    }

    private function createOrderItems($request, $order)
    {
        $cart = json_decode($order['cart'], true);
        $arrayIdCartChecked = session('array_id', []);

        $orderItems = [];

        if (isset($cart['cart_items']) && is_array($cart['cart_items'])) {
            foreach ($cart['cart_items'] as $item) {
                // kiểm tra có trong sssion 
                if (in_array($item['id'], $arrayIdCartChecked)) {
                    $productName = isset($item['products']['name'])
                        ? $item['products']['name']
                        : ($item['product_variants']['name'] ?? 'Sản phẩm hiện đang phát hành');

                    $orderItems[] = [
                        'order_id'           => $order->id,
                        'product_id'         => $item['product_id'] ?? null,
                        'product_variant_id' => $item['product_variant_id'] ?? null,
                        'product_name'       => $productName,
                        'final_quantity'     => $item['quantity'] ?? 1,
                        'final_price'        => $item['price'] ?? 0,
                    ];
                }
            }
        }

        
        if (!empty($orderItems)) {
            $order->orderItems()->createMany($orderItems);
        }
    }

    public function update($request)
    {
        DB::beginTransaction();
        try {
            $payload = $request->input();
            // dd($payload);
            $this->orderRepository->updateById($payload['id'], $payload);

            DB::commit();
            // die();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            echo $e->getMessage();
            return false;
        }
    }
    public function updateStatusPayment($payload, $order)
    {
        DB::beginTransaction();
        try {
            $this->orderRepository->updateById($order->id, $payload);
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            echo $e->getMessage();
            return false;
        }
    }

    public function updateQuantitySoldProduct($order)
    {
        DB::beginTransaction();
        try {
            $order = $this->orderRepository->findById($order->id, ['orderItems', 'orderItems.products', 'orderItems.productVariants']);
            foreach ($order->orderItems as $val) {
                if (!empty($val->product_id) && is_numeric($val->product_id)) {
                    $product = $this->productRepository->findById((int) $val->product_id);
                    if ($product) {
                        $product->instock -= $val->final_quantity;
                        $product->sold_count += $val->final_quantity;
                        $product->save();
                    }
                }
                if (!empty($val->product_variant_id) && is_numeric($val->product_variant_id)) {
                    $productVariant = $this->productVariantRepository->findById((int) $val->product_variant_id);
                    if ($productVariant) {
                        $productVariant->quantity -= $val->final_quantity;
                        $productVariant->sold_count += $val->final_quantity;
                        $productVariant->save();
                    }
                }
            }
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            echo $e->getMessage();
            return false;
        }
    }

    public function updatePaidAt($orderId, $payload)
    {
        DB::beginTransaction();
        try {
            $this->orderRepository->updateById($orderId, $payload);
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            echo $e->getMessage();
            return false;
        }
    }

    // DASHBOARD
    public function totalMoneyOrder()
    {
        $totalOrder = $this->orderRepository->allWhere([
            [DB::raw('YEAR(created_at)'), '=', Carbon::now()->year],
            ['payment', 'paid'],
            ['status', 'completed'],
            ['paid_at', '!=', null],
        ]);
        $totalMoney = 0;
        if (count($totalOrder) > 0) {
            foreach ($totalOrder as $val) {
                $totalMoney += (float) $val->total_amount;
            }
        }
        return $totalMoney;
    }
    public function totalMoneyOrderMonth()
    {
        $totalOrder = $this->orderRepository->allWhere([
            [DB::raw('MONTH(created_at)'), '=', Carbon::now()->month],
            ['payment', 'paid'],
            ['status', 'completed'],
            ['paid_at', '!=', null],
        ]);
        $totalMoney = 0;
        if (count($totalOrder) > 0) {
            foreach ($totalOrder as $val) {
                $totalMoney += (float) $val->total_amount;
            }
        }
        return $totalMoney;
    }
    public function countTotalOrder()
    {
        $count = $this->orderRepository->allWhere([
            [DB::raw('YEAR(created_at)'), '=', Carbon::now()->year],
            ['payment', 'paid'],
            ['status', 'completed'],
            ['paid_at', '!=', null],
        ])->count();
        return $count;
    }
    public function countTotalOrderMonth()
    {
        $count = $this->orderRepository->allWhere([
            [DB::raw('MONTH(created_at)'), '=', Carbon::now()->month],
            ['payment', 'paid'],
            ['status', 'completed'],
            ['paid_at', '!=', null],
        ])->count();
        return $count;
    }

    public function countOrderFul12Month()
    {
        $orders = DB::table('orders')
            ->select(DB::raw('MONTH(created_at) as month'), DB::raw('COUNT(*) as count'))
            ->where('payment', 'paid')
            ->where('status', 'completed')
            ->where('paid_at', '!=', null)
            ->whereYear('created_at', Carbon::now()->year)
            ->groupBy(DB::raw('MONTH(created_at)'))
            ->pluck('count', 'month');
        $monthValCounts = array_fill(1, 12, 0); // đủ 12 cho dù có tháng = 0

        foreach ($orders as $month => $count) {
            $monthValCounts[$month] = $count;
        }

        return $monthValCounts;
    }
    public function countMoneyFul12Month()
    {
        $orders = DB::table('orders')
            ->select(DB::raw('MONTH(created_at) as month'), DB::raw('SUM(total_amount) as total_value'))
            ->where('payment', 'paid')
            ->where('status', 'completed')
            ->where('paid_at', '!=', null)
            ->whereYear('created_at', Carbon::now()->year)
            ->groupBy(DB::raw('MONTH(created_at)'))
            ->pluck('total_value', 'month');
        $monthValCounts = array_fill(1, 12, 0); // đủ 12 cho dù có tháng = 0

        foreach ($orders as $month => $total) {
            $monthValCounts[$month] = $total;
        }

        return $monthValCounts;
    }

    public function orderRecent()
    {
        $condition = [
            'where' => [
                ['status', '!=', 'pending'],
            ]
        ];
        $relation = ['user'];
        $perPage = 5;
        $orders = $this->orderRepository->pagination(
            $this->paginateSelect(),
            $condition,
            $relation,
            ['created_at', 'desc'],
            $perPage,
        );

        return $orders;
    }

    // FONTEND

    public function paginateOrderFontend($request)
    {
        $condition = [
            'keyword' => addslashes($request->input('keyword')),
            'where' => [
                ['customer_id', '=',  Auth::id()]
            ]
        ];
        $condition['created_at'] = $request->input('created_at');
        $relation = ['orderItems', ['orderItems.products'], 'orderItems.productVariants'];
        $perPage = $request->integer('perpage') ?: 10;
        $orders = $this->orderRepository->pagination(
            $this->paginateSelect(),
            $condition,
            $relation,
            ['id', 'DESC'],
            $perPage,
        );

        return $orders;
    }
    public function paginateOrderPending($request)
    {
        $condition = [
            'keyword' => addslashes($request->input('keyword')),
            'where' => [
                ['customer_id', '=',  Auth::id()],
                ['status', '=',  'pending'],

            ]
        ];
        $condition['created_at'] = $request->input('created_at');
        $relation = ['orderItems', ['orderItems.products'], 'orderItems.productVariants'];
        $perPage = $request->integer('perpage') ?: 10;
        $orders = $this->orderRepository->pagination(
            $this->paginateSelect(),
            $condition,
            $relation,
            ['id', 'DESC'],
            $perPage,
        );

        return $orders;
    }
    public function paginateOrderConfirmed($request)
    {
        $condition = [
            'keyword' => addslashes($request->input('keyword')),
            'where' => [
                ['customer_id', '=',  Auth::id()],
                ['status', '=',  'confirmed']
            ]
        ];
        $condition['created_at'] = $request->input('created_at');
        $relation = ['orderItems', ['orderItems.products'], 'orderItems.productVariants'];
        $perPage = $request->integer('perpage') ?: 10;
        $orders = $this->orderRepository->pagination(
            $this->paginateSelect(),
            $condition,
            $relation,
            ['id', 'DESC'],
            $perPage,
        );

        return $orders;
    }
    public function paginateOrderShipping($request)
    {
        $condition = [
            'keyword' => addslashes($request->input('keyword')),
            'where' => [
                ['customer_id', '=',  Auth::id()],
                ['status', '=',  'shipping']
            ]
        ];
        $condition['created_at'] = $request->input('created_at');
        $relation = ['orderItems', ['orderItems.products'], 'orderItems.productVariants'];
        $perPage = $request->integer('perpage') ?: 10;
        $orders = $this->orderRepository->pagination(
            $this->paginateSelect(),
            $condition,
            $relation,
            ['id', 'DESC'],
            $perPage,
        );

        return $orders;
    }
    public function paginateOrderCanceled($request)
    {
        $condition = [
            'keyword' => addslashes($request->input('keyword')),
            'where' => [
                ['customer_id', '=',  Auth::id()],
                ['status', '=',  'canceled']
            ]
        ];
        $condition['created_at'] = $request->input('created_at');
        $relation = ['orderItems', ['orderItems.products'], 'orderItems.productVariants'];
        $perPage = $request->integer('perpage') ?: 10;
        $orders = $this->orderRepository->pagination(
            $this->paginateSelect(),
            $condition,
            $relation,
            ['id', 'DESC'],
            $perPage,
        );

        return $orders;
    }
    public function paginateOrderCompleted($request)
    {
        $condition = [
            'keyword' => addslashes($request->input('keyword')),
            'where' => [
                ['customer_id', '=',  Auth::id()],
                ['status', '=',  'completed']
            ]
        ];
        $condition['created_at'] = $request->input('created_at');
        $relation = ['orderItems', ['orderItems.products'], 'orderItems.productVariants'];
        $perPage = $request->integer('perpage') ?: 10;
        $orders = $this->orderRepository->pagination(
            $this->paginateSelect(),
            $condition,
            $relation,
            ['id', 'DESC'],
            $perPage,
        );

        return $orders;
    }
    public function findAttributesByCode()
    {
        $orders = $this->all();
        $attributesByOrderItem = [];
        if (isset($orders->orderItems) && count($orders->orderItems) > 0) {
            foreach ($orders->orderItems as $orderItem) {
                if ($orderItem->productVariants) {
                    $codeIds = explode(',', $orderItem->productVariants->code);
                    $attributes = Attribute::whereIn('id', $codeIds)->get();

                    //lấy dúng attribut của cartitem đó
                    $attributesByOrderItem[$orderItem->id] = $attributes;
                }
            }
        }
        return $attributesByOrderItem;
    }
    private function paginateSelect()
    {
        return [
            'id',
            'code',
            'customer_id',
            'email',
            'full_name',
            'phone',
            'province_id',
            'district_id',
            'ward_id',
            'address',
            'note',
            'cart',
            'total_amount',
            'total_items',
            'status',
            'payment_method',
            'payment',
            'paid_at',
            'created_at',
        ];
    }
}
