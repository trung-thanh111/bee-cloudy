<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Services\OrderService;
use App\Http\Controllers\Controller;
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
    public function detail($id){
        $order = $this->orderRepository->findById($id);
        $template = 'backend.order.detail';
        return view('backend.dashboard.layout', compact(
            'template',
            'order',
        ));
    }
    
    
    
}
