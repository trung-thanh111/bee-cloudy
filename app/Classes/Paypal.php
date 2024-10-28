<?php
namespace App\Classes;

use Srmklive\PayPal\Services\PayPal as PayPalClient;

class Paypal
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
        $provider = new PayPalClient;
        dd($provider);
        // $provider = \PayPal::setProvider();
        $provider->getAccessToken();
        echo 1; die();
    }
}
