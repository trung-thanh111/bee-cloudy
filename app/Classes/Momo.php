<?php

namespace App\Classes;

class Momo
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
        $endpoint = "https://test-payment.momo.vn/v2/gateway/api/create";

        $configMomo = momoConfig();
        $partnerCode = $configMomo['partnerCode'];
        $accessKey = $configMomo['accessKey'];
        $secretKey = $configMomo['secretKey'];

        $orderInfo = (!empty($order->note) ? $order->note : 'Thanh toán đơn hàng qua ví Momo');
        $amount = (int)$order->total_amount;
        $orderId = $order->code;
        $redirectUrl = url('return/momo');
        $ipnUrl = url('return/momo_ipn');
        $requestType = 'payWithATM'; // 'captureWallet' // Thay đổi requestType
        $requestId = $order->code;
        $extraData = "";

        $rawHash =
            "accessKey=" . $accessKey .
            "&amount=" . $amount .
            "&extraData=" . $extraData .
            "&ipnUrl=" . $ipnUrl .
            "&orderId=" . $orderId .
            "&orderInfo=" . $orderInfo .
            "&partnerCode=" . $partnerCode .
            "&redirectUrl=" . $redirectUrl .
            "&requestId=" . $requestId .
            "&requestType=" . $requestType;

        $signature = hash_hmac("sha256", $rawHash, $secretKey);

        $data = array(
            'partnerCode' => $partnerCode,
            'requestId' => $requestId,
            'amount' => $amount,
            'orderId' => $orderId,
            'orderInfo' => $orderInfo,
            'redirectUrl' => $redirectUrl,
            'ipnUrl' => $ipnUrl,
            'lang' => 'vi',
            'extraData' => $extraData,
            'requestType' => $requestType,
            'signature' => $signature
        );


        $result = execPostRequest($endpoint, json_encode($data));


        $jsonResult = json_decode($result, true);
        $dataReturn = [
            'url' => $jsonResult['payUrl'],
            'orderId' => $orderId,
            'requestId' => $requestId,
            'amount' => $amount,
            "resultCode" => $jsonResult['resultCode'],
            'response' => $jsonResult
        ];
        return $dataReturn;
    }
}
