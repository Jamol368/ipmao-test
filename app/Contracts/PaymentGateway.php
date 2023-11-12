<?php

namespace App\Contracts;

interface PaymentGateway
{
    public function check($data, $sign);
}
