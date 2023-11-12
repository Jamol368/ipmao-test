<?php

namespace App\Services;

use App\Contracts\PaymentGateway;

class PaymentService
{
    private PaymentGateway $paymentGateway;
    private $data;
    private $sign;

    public function setPaymentGateway(PaymentGateway $paymentGateway)
    {
        $this->paymentGateway = $paymentGateway;
    }

    public function setData($data, $sign)
    {
        $this->data = $data;
        $this->sign = $sign;
    }

    public function processPayment()
    {
        return $this->paymentGateway->check($this->data, $this->sign);
    }
}
