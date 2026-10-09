<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Services\OrderService;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCancelOrderRequest;
use App\Repositories\OrderRepository;

class OrderController extends Controller
{
    protected $orderService;
    protected $orderRepository;
    protected $attributeCatalogueRepository;
    protected $orderCatalogueRepository;
    protected $brandRepository;
    public function __construct(
        OrderService $orderService,
        OrderRepository $orderRepository,
    ) {
        $this->orderService = $orderService;
        $this->orderRepository = $orderRepository;
    }

    public function index(Request $request)
    {
        $orders = $this->orderService->paginate($request);
        // dd($orders);
        $template = 'backend.order.index';
        return view('backend.dashboard.layout', compact(
            'template',
            'orders',
        ));
    }
    public function detail($id)
    {
        $order = $this->orderRepository->findById($id);
        $attributesByOderItem = $this->orderService->findAttributesByCode();
        $template = 'backend.order.detail';
        return view('backend.dashboard.layout', compact(
            'template',
            'order',
            'attributesByOderItem',
        ));
    }
    public function process_cancele(StoreCancelOrderRequest $request, $id)
    {
        $order = $this->orderRepository->findById($id);
        $payload = $request->only('cancellation_reason', 'canceled_by');

        if (!$order) {
            return redirect()->back()->with('error', 'Đơn hàng không tồn tại.');
        } else {
            $order->update($payload);
            $this->orderService->sendMailFail($order);
            return redirect()->back()->with('success', 'Đơn hàng đã được hủy thành công.');
        }

        $template = 'backend.order.cancele';
        return view('backend.dashboard.layout', compact(
            'template',
            'order'
        ));
    }
}
