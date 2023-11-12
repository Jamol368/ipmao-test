<?php

namespace App\Actions;

use App\Services\AppPaymentGateway;
use App\Services\MerchantPaymentGateway;
use App\Services\PaymentService;

class UpdatePaymentAction
{
    public function execute($data, $sign)
    {
        $service = new PaymentService();

        if ($sign){
            $service->setPaymentGateway(new AppPaymentGateway());
        } else {
            $service->setPaymentGateway(new MerchantPaymentGateway());
        }

        $service->setData($data, $sign);
        $status = $service->processPayment();

        return $status;
    }
}
