<?php

namespace App\Classes;

class Vnpay
{

    
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public function payment($order)
    {
        $configVnpay = vnpayConfig();
        
        $vnp_TmnCode = $configVnpay['vnp_TmnCode']; 
        $vnp_HashSecret = $configVnpay['vnp_HashSecret']; 
        $vnp_Url = $configVnpay['vnp_Url'];
        $vnp_Returnurl = $configVnpay['vnp_Returnurl'];

        $vnp_TxnRef = $order->code; //Mã đơn hàng
        $vnp_OrderInfo = (!empty($order->note) ? $order->note : 'Thanh toán đơn hàng #'.$order->code.' qua ví VNpay');
        $vnp_OrderType = 'paymentOnline';
        $vnp_Amount = $order->total_amount * 100;
        $vnp_Locale = 'vn';
        $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];
        
        $inputData = array(
            "vnp_Version" => "2.1.0",
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => $vnp_Amount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => $vnp_OrderInfo,
            "vnp_OrderType" => $vnp_OrderType,
            "vnp_ReturnUrl" => $vnp_Returnurl,
            "vnp_TxnRef" => $vnp_TxnRef,
        );

        if (isset($vnp_BankCode) && $vnp_BankCode != "") {
            $inputData['vnp_BankCode'] = $vnp_BankCode;
        }
        ksort($inputData);
        $query = "";
        $i = 0;
        $hashdata = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashdata .= urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }

        $vnp_Url = $vnp_Url . "?" . $query;
        if (isset($vnp_HashSecret)) {
            $vnpSecureHash =   hash_hmac('sha512', $hashdata, $vnp_HashSecret); //  
            $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
        }
        $returnData = array(
            'resultCode' => 0,
            'message' => 'success',
            'url' => $vnp_Url
        );
        return $returnData;
        
    }
}
