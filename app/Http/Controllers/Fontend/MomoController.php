<?php

namespace App\Http\Controllers\Fontend;

use Exception;
use App\Classes\Momo;
use Illuminate\Http\Request;
use App\Services\CartService;
use App\Services\OrderService;
use Illuminate\Support\Facades\Auth;
use App\Repositories\OrderRepository;
use App\Http\Controllers\FontendController;

class MomoController extends FontendController
{

    protected $momo;
    protected $cartService;
    protected $orderService;
    protected $orderRepository;


    public function __construct(
        Momo $momo,
        CartService $cartService,
        OrderService $orderService,
        OrderRepository $orderRepository,
    ) {
        $this->momo = $momo;
        $this->cartService = $cartService;
        $this->orderService = $orderService;
        $this->orderRepository = $orderRepository;
    }

    public function momoReturn(Request $request)
    {
        $configMomo = momoConfig();
        $secretKey = $configMomo['secretKey'];

        if (!empty($_GET)) {
            $partnerCode = $_GET["partnerCode"];
            $accessKey = '';
            $orderId = $_GET["orderId"];
            $localMessage = '';
            $message = $_GET["message"];
            $transId = $_GET["transId"];
            $orderInfo = json_encode($_GET["orderInfo"]);
            $amount = $_GET["amount"];
            $resultCode = $_GET["resultCode"];
            $responseTime = $_GET["responseTime"];
            $requestId = $_GET["requestId"];
            $extraData = $_GET["extraData"];
            $payType = $_GET["payType"];
            $orderType = $_GET["orderType"];
            $extraData = $_GET["extraData"];
            $m2signature = $_GET["signature"]; //MoMo signature

            //Checksum
            $rawHash = "partnerCode=" . $partnerCode . "&accessKey=" . $accessKey . "&requestId=" . $requestId . "&amount=" . $amount . "&orderId=" . $orderId . "&orderInfo=" . $orderInfo .
                "&orderType=" . $orderType . "&transId=" . $transId . "&message=" . $message . "&localMessage=" . $localMessage . "&responseTime=" . $responseTime . "&resultCode=" . $resultCode .
                "&payType=" . $payType . "&extraData=" . $extraData;

            $partnerSignature = hash_hmac("sha256", $rawHash, $secretKey);


            $order = $this->orderRepository->findOrderFirst(
                [
                    ['code', '=', $orderId],
                    ['customer_id', '=', Auth::id()]
                ],
                [],
                [
                    ['created_at', 'desc']
                ]
            );

            // TẠM THỜI 
            if ($resultCode == '0') { // Thanh toán thành công
                $payload = [
                    'payment' =>'paid',
                    'status' => 'confirmed',
                    'paid_at' => now()->format('Y-m-d H:i:s'),
                ];
                $this->orderService->updateStatusPayment($payload, $order);
                $this->orderService->updatePaidAt($order->id, $payload);
                $this->orderService->sendMail($order);
                $this->cartService->destroyCartItem($request);
                flash()->success('Giao dịch thành công.');
                return view('fontend.order.success', compact('order'));
            } else { // Thanh toán thất bại
                $payload = [
                    'payment' => 'failed',
                    'status' => 'pending' // Hoặc trạng thái khác
                ];
                $this->orderService->updateStatusPayment($payload, $order);
                flash()->error('Giao dịch thất bại!.');
                return view('fontend.order.failed', compact('order'));
            }

        }
    }
    public function momoIpn(Request $request)
    {
        http_response_code(200); 
        if (!empty($_POST)) {
            $response = array();
            try {
                $partnerCode = $_GET["partnerCode"];
                $accessKey = '';
                $orderId = $_GET["orderId"];
                $localMessage = '';
                $message = $_GET["message"];
                $transId = $_GET["transId"];
                $orderInfo = json_encode($_GET["orderInfo"]);
                $amount = $_GET["amount"];
                $resultCode = $_GET["resultCode"];
                $responseTime = $_GET["responseTime"];
                $requestId = $_GET["requestId"];
                $extraData = $_GET["extraData"];
                $payType = $_GET["payType"];
                $orderType = $_GET["orderType"];
                $extraData = $_GET["extraData"];
                $m2signature = $_GET["signature"]; 
                //Checksum
                $rawHash = "partnerCode=" . $partnerCode . "&accessKey=" . $accessKey . "&requestId=" . $requestId . "&amount=" . $amount . "&orderId=" . $orderId . "&orderInfo=" . $orderInfo .
                    "&orderType=" . $orderType . "&transId=" . $transId . "&message=" . $message . "&localMessage=" . $localMessage . "&responseTime=" . $responseTime . "&resultCode=" . $resultCode .
                    "&payType=" . $payType . "&extraData=" . $extraData;

                $partnerSignature = hash_hmac("sha256", $rawHash, 'at67qH6mk8w5Y1nAyMoYKMWACiEi2bsa');

                $order = $this->orderRepository->findOrderFirst(
                    [
                        ['code', '=', $orderId],
                        ['customer_id', '=', Auth::id()]
                    ],
                    [],
                    [
                        ['created_at', 'desc']
                    ]
                );
                if ($m2signature == $partnerSignature) {
                    if ($resultCode == '0') { // Thanh toán thành công
                        $payload = [
                            'payment' =>'paid',
                            'status' => 'confirmed',
                            'paid_at' => now()->format('Y-m-d H:i:s'),
                        ];
                        $this->orderService->updateStatusPayment($payload, $order);
                        $this->orderService->updatePaidAt($order->id, $payload);
                        $this->orderService->sendMail($order);
                        $this->cartService->destroyCartItem($request);
                        flash()->success('Giao dịch thành công.');
                        return view('fontend.order.success', compact('order'));
                    } else { // Thanh toán thất bại
                        $payload = [
                            'payment' => 'failed',
                            'status' => 'pending' // Hoặc trạng thái khác
                        ];
                        $this->orderService->updateStatusPayment($payload, $order);
                        $this->cartService->destroyCartItem($request);
                        flash()->error('Giao dịch thất bại!.');
                        return view('fontend.order.failed', compact('order'));
                    }
                } else { 
                    flash()->warning('Giao dịch này có thể bị hack, vui lòng kiểm tra chữ ký của bạn và chữ ký đã trả lại.');
                }
            } catch (Exception $e) {
                echo $response['message'] = $e;
            }

            $debugger = array();
            $debugger['rawData'] = $rawHash;
            $debugger['momoSignature'] = $m2signature;
            $debugger['partnerSignature'] = $partnerSignature;

            if ($m2signature == $partnerSignature) {
                $response['message'] = "Received payment result success";
            } else {
                $response['message'] = "ERROR! Fail checksum";
            }
            $response['debugger'] = $debugger;
            echo json_encode($response);
        }
    }
}
