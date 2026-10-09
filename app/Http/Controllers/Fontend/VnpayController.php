<?php

namespace App\Http\Controllers\Fontend;

use Exception;
use App\Classes\Vnpay;
use Illuminate\Http\Request;
use App\Services\OrderService;
use Illuminate\Support\Facades\Auth;
use App\Repositories\OrderRepository;
use App\Http\Controllers\FontendController;
use App\Services\CartService;

class VnpayController extends FontendController
{

    protected $vnpay;
    protected $cartService;
    protected $orderService;
    protected $orderRepository;

    public function __construct(
        Vnpay $vnpay,
        CartService $cartService,
        OrderService $orderService,
        OrderRepository $orderRepository,
    ) {

        $this->vnpay = $vnpay;
        $this->cartService = $cartService;
        $this->orderService = $orderService;
        $this->orderRepository = $orderRepository;
    }

    public function vnpayReturn(Request $request)
    {
        $configVnpay = vnpayConfig();

        $vnp_TmnCode = $configVnpay['vnp_TmnCode'];
        $vnp_HashSecret = $configVnpay['vnp_HashSecret'];
        $vnp_Url = $configVnpay['vnp_Url'];
        $vnp_Returnurl = $configVnpay['vnp_Returnurl'];
        $vnp_apiUrl = $configVnpay['vnp_apiUrl'];
        $apiUrl = $configVnpay['apiUrl'];

        $startTime = date('YmdHis');
        $expire = date('YmdHis', strtotime('+15 minutes', strtotime($startTime)));

        $vnp_SecureHash = $_GET['vnp_SecureHash'];
        $inputData = array();
        foreach ($_GET as $key => $value) {
            if (substr($key, 0, 4) == "vnp_") {
                $inputData[$key] = $value;
            }
        }

        unset($inputData['vnp_SecureHash']);
        ksort($inputData);
        $i = 0;
        $hashData = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashData = $hashData . '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashData = $hashData . urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
        }

        $secureHash = hash_hmac('sha512', $hashData, $vnp_HashSecret);
        // dd($_GET['vnp_ResponseCode']);
        if ($secureHash == $vnp_SecureHash) {
            $orderCode = $request->input('vnp_TxnRef');
            $order = $this->orderRepository->findOrderFirst(
                [
                    ['code', '=', $orderCode],
                    ['customer_id', '=', Auth::id()]
                ],
                [],
                [
                    ['created_at', 'desc']
                ]
            );
            if ($_GET['vnp_ResponseCode'] == '00') {
                // lấy thông tin đơn hàng
                // TẠM THÒI
                $payload = [
                    'payment' => 'paid',
                    'status' => 'confirmed'
                ];

                flash()->success('Giao dịch thành công.');
                return view('fontend.order.success', compact('order'));
            } else {
                $payload = [
                    'payment' => 'failed',
                    'status' => 'pending',
                    'paid_at' => now()->format('Y-m-d H:i:s'),
                ];
                flash()->error('Giao dịch không thành công.');
            }
            $this->orderService->updateStatusPayment($payload, $order);
            $this->orderService->updatePaidAt($order->id, $payload);
            $this->orderService->sendMail($order);
            $this->cartService->destroyCartItem($request);

        } else {
            flash()->error('Chữ ký không hợp lệ.');
        }
    }
    public function vnpayIpn(Request $request)
    {
        /* Payment Notify
     * IPN URL: Ghi nhận kết quả thanh toán từ VNPAY
     * Các bước thực hiện:
     * Kiểm tra checksum 
     * Tìm giao dịch trong database
     * Kiểm tra số tiền giữa hai hệ thống
     * Kiểm tra tình trạng của giao dịch trước khi cập nhật
     * Cập nhật kết quả vào Database
     * Trả kết quả ghi nhận lại cho VNPAY
     */

        $configVnpay = vnpayConfig();

        $vnp_TmnCode = $configVnpay['vnp_TmnCode'];
        $vnp_HashSecret = $configVnpay['vnp_HashSecret'];
        $vnp_Url = $configVnpay['vnp_Url'];
        $vnp_Returnurl = $configVnpay['vnp_Returnurl'];
        $vnp_apiUrl = $configVnpay['vnp_apiUrl'];
        $apiUrl = $configVnpay['apiUrl'];

        $startTime = date('YmdHis');
        $expire = date('YmdHis', strtotime('+15 minutes', strtotime($startTime)));

        $inputData = array();
        $returnData = array();

        foreach ($_GET as $key => $value) {
            if (substr($key, 0, 4) == "vnp_") {
                $inputData[$key] = $value;
            }
        }

        $vnp_SecureHash = $inputData['vnp_SecureHash'];
        unset($inputData['vnp_SecureHash']);
        ksort($inputData);
        $i = 0;
        $hashData = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashData = $hashData . '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashData = $hashData . urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
        }

        $secureHash = hash_hmac('sha512', $hashData, $vnp_HashSecret);
        $vnpTranId = $inputData['vnp_TransactionNo']; //Mã giao dịch tại VNPAY
        $vnp_BankCode = $inputData['vnp_BankCode']; //Ngân hàng thanh toán
        $vnp_Amount = $inputData['vnp_Amount'] / 100; // Số tiền thanh toán VNPAY phản hồi

        $Status = 0; // Là trạng thái thanh toán của giao dịch chưa có IPN lưu tại hệ thống của merchant chiều khởi tạo 
        // URL thanh toán.
        $orderId = $inputData['vnp_TxnRef'];


        try {
            //Check Orderid    
            //Kiểm tra checksum của dữ liệu
            if ($secureHash == $vnp_SecureHash) {
                //Lấy thông tin đơn hàng lưu trong Database và kiểm tra trạng thái của đơn hàng, mã đơn hàng là: $orderId            
                //Việc kiểm tra trạng thái của đơn hàng giúp hệ thống không xử lý trùng lặp, xử lý nhiều lần một giao dịch
                //Giả sử: $order = mysqli_fetch_assoc($result);   

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
                if ($order != NULL) {
                    if ($order->total_amount == $vnp_Amount) //Kiểm tra số tiền thanh toán của giao dịch: giả sử số tiền 
                    // kiểm tra là đúng. //$order["Amount"] == $vnp_Amount
                    {
                        if ($order->payment != NULL && $order->status == 'unpaid') {
                            if ($inputData['vnp_ResponseCode'] == '00' || $inputData['vnp_TransactionStatus'] == '00') {
                                $payload = [
                                    'payment' => 'paid',
                                    'status' => 'confirmed',
                                    'paid_at' => now()->format('Y-m-d H:i:s'),
                                ];
                            } else {
                                $payload = [
                                    'payment' => 'failed',
                                    'status' => 'pending'
                                ];
                            }
                            //cập nhật lại trạng thái đơn đơn hàng và trang thái payment
                            $this->orderService->updateStatusPayment($payload, $order);
                            $this->orderService->updatePaidAt($order->id, $payload);
                            $this->orderService->sendMail($order);
                            $this->cartService->destroyCartItem($request);

                            // bên dưới trả lại kq cho vn pay

                            $returnData['RspCode'] = '00';
                            $returnData['Message'] = 'Confirm Success';
                        } else {
                            $returnData['RspCode'] = '02';
                            $returnData['Message'] = 'Order already confirmed';
                        }
                    } else {
                        $returnData['RspCode'] = '04';
                        $returnData['Message'] = 'invalid amount';
                    }
                } else {
                    $returnData['RspCode'] = '01';
                    $returnData['Message'] = 'Order not found';
                }
            } else {
                $returnData['RspCode'] = '97';
                $returnData['Message'] = 'Invalid signature';
            }
        } catch (Exception $e) {
            $returnData['RspCode'] = '99';
            $returnData['Message'] = 'Unknow error';
        }
        //Trả lại VNPAY theo định dạng JSON
        echo json_encode($returnData);
    }
}
