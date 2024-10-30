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
            ['orderItems', 'orderItems.productVariants', 'orderItems.productVariants.attributes', 'orderItems.products'],
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
                // xóa cart sao khi thanh toán hành tất 
                // $this->cartService->clear();
            }
            DB::commit();
            // die();
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


    private function preparePayload($request)
    {
        $payload = $request->except(['_token', 'submit']);
        $payload['code'] = Str::upper(Str::random(2, 'ABCDEFGHIJKLMNOPQRSTUVWXYZ')) . time();
        $payload['customer_id'] = Auth::id();
        $payload['address'] = $payload['address'].', '.$payload['ward_name'].', '.$payload['district_name'].', '.$payload['province_name'];
        $payload['cart'] = json_encode($this->cartService->all());
        $payload['total_items'] = $this->cartService->countProductIncart();
        return $payload;
    }

    private function createOrderitems($request, $order)
    {
        $cart = json_decode($order['cart'], true);

        $orderItem = [];

        if (isset($cart['cart_items']) && is_array($cart['cart_items'])) {
            foreach ($cart['cart_items'] as $item) {
                $productName = isset($item['products']['name'])
                    ? $item['products']['name']
                    : ($item['product_variants']['name'] ?? 'Sản phẩm hiện đang phát hành');

                $orderItem[] = [
                    'order_id'           => $order->id,
                    'product_id'         => $item['product_id'] ?? null,
                    'product_variant_id' => $item['product_variant_id'] ?? null,
                    'product_name'       => $productName,
                    'final_quantity'     => $item['quantity'] ?? 1,
                    'final_price'        => $item['price'] ?? 0,
                ];
            }
        }


        // insert vào bảng order-item thông qua mối quan hệ với createMany()
        $order->orderItems()->createMany($orderItem);
    }

    public function update($request ){
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
    public function updateStatusPayment($payload, $order ){
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



    // FONTEND

    public function paginateOrderFontend($request)
    {
        $condition = [
            'keyword' => addslashes($request->input('keyword')),
            'where' => [
                ['customer_id', '=',  Auth::id()]
            ]
        ];
        $condition['created_at'] = $request->input('created_at') ;
        $relation = ['orderItems', ['orderItems.products'], 'orderItems.productVariants'];
        $perPage = $request->integer('perpage') ?: 5;
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
                ['status', '=',  'pending']
            ]
        ];
        $condition['created_at'] = $request->input('created_at') ;
        $relation = ['orderItems', ['orderItems.products'], 'orderItems.productVariants'];
        $perPage = $request->integer('perpage') ?: 5;
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
        $condition['created_at'] = $request->input('created_at') ;
        $relation = ['orderItems', ['orderItems.products'], 'orderItems.productVariants'];
        $perPage = $request->integer('perpage') ?: 5;
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
        $condition['created_at'] = $request->input('created_at') ;
        $relation = ['orderItems', ['orderItems.products'], 'orderItems.productVariants'];
        $perPage = $request->integer('perpage') ?: 5;
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
        $condition['created_at'] = $request->input('created_at') ;
        $relation = ['orderItems', ['orderItems.products'], 'orderItems.productVariants'];
        $perPage = $request->integer('perpage') ?: 5;
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
        $condition['created_at'] = $request->input('created_at') ;
        $relation = ['orderItems', ['orderItems.products'], 'orderItems.productVariants'];
        $perPage = $request->integer('perpage') ?: 5;
        $orders = $this->orderRepository->pagination(
            $this->paginateSelect(),
            $condition,
            $relation,
            ['id', 'DESC'],
            $perPage,
        );

        return $orders;
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
            'created_at',
        ];
    }
}
