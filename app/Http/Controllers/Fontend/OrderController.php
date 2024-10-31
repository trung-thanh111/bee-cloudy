<?php

namespace App\Http\Controllers\Fontend;

use App\Http\Controllers\FontendController;
use App\Http\Requests\StoreOrderRequest;
use App\Models\Order;
use App\Repositories\OrderRepository;
use App\Repositories\ProductRepository;
use App\Services\CartService;
use App\Services\OrderService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Classes\Vnpay;
use App\Classes\Momo;
use App\Classes\Paypal;

class OrderController extends FontendController
{
    protected $orderRepository;
    protected $orderService;
    protected $cartService;
    protected $vnpay;
    protected $momo;
    protected $paypal;

    public function __construct(
        OrderRepository $orderRepository,
        OrderService $orderService,
        CartService $cartService,
        Vnpay $vnpay,
        Momo $momo,
        Paypal $paypal,
    ) {
        $this->orderRepository = $orderRepository;
        $this->cartService = $cartService;
        $this->orderService = $orderService;
        $this->vnpay = $vnpay;
        $this->momo = $momo;
        $this->paypal = $paypal;
    }

    public function view_order(Request $request)
    { {
            $order_all = $this->orderService->paginateOrderFontend($request);
            $order_pending = $this->orderService->paginateOrderPending($request);
            $order_confirmed = $this->orderService->paginateOrderConfirmed($request);
            $order_shipping = $this->orderService->paginateOrderShipping($request);
            $order_canceled = $this->orderService->paginateOrderCanceled($request);
            $order_completed = $this->orderService->paginateOrderCompleted($request);
            return view('fontend.account.view_order', compact(
                'order_all',
                'order_pending',
                'order_confirmed',
                'order_shipping',
                'order_canceled',
                'order_completed',
            ));
        }
    }
    public function checkout(Request $request)
    {
        $carts = $this->cartService->all();

        return view('fontend.order.checkout', compact(
            'carts'
        ));
    }
    public function store(StoreOrderRequest $request)
    {
        $order = $this->orderService->create($request);
        if ($order['payment_method'] !== 'cod') {
            $response = $this->paymentMethod($order);
            if ($response) {
                if ($response['resultCode'] == 0) {
                    return redirect()->away($response['url']);
                }
                flash()->success('Đặt hàng thành công');
                return redirect()->route('order.success');
            }
            flash()->error('Thất bại. Đã có lỗi xảy ra vui lòng thử lại!');
            return redirect()->back();
        } else {
            $this->orderService->sendMail($order);
            flash()->success('Đặt hàng thành công');
            return redirect()->route('order.success');
        }
    }

    public function paymentMethod($order = null)
    {
        $reponse = null;
        switch ($order->payment_method) {
            case 'vnpay':
                $response = $this->vnpay->payment($order);
                break;
            case 'momo':
                $response = $this->momo->payment($order);
                break;
            case 'paypal':
                $response = $this->paypal->payment($order);
                break;
        }
        return $response;
    }
    public function success()
    {
        $order = $this->orderRepository->findOrderFirst(
            [
                ['customer_id', '=', Auth::id()]
            ],
            [],
            [
                ['created_at', 'desc']
            ]
        );
        // $order = Order::where('customer_id', Auth::id())
        //     ->orderBy('created_at', 'desc')->first(['code']);
        return view('fontend.order.success', compact('order'));
    }
    public function failed()
    {
        $order = $this->orderRepository->findOrderFirst(
            [
                ['customer_id', '=', Auth::id()]
            ],
            [],
            [
                ['created_at', 'desc']
            ]
        );
        // $order = Order::where('customer_id', Auth::id())
        //     ->orderBy('created_at', 'desc')->first(['code']);
        return view('fontend.order.failed', compact('order'));
    }

    public function detail($id)
    {
        $order = $this->orderRepository->findById($id);
        $attributesByOderItem = $this->orderService->findAttributesByCode();
        return view('fontend.account.order_detail', compact(
            'order',
            'attributesByOderItem',));
    }
}
