<?php

namespace App\Services;

use App\Contracts\PaymentGateway;
use App\Models\Payment;

class AppPaymentGateway implements PaymentGateway
{
    public function check($data, $sign)
    {
        arsort($data);
        $generated_sign = md5(implode('.', $data) . '.app_key');
        if ($sign === $generated_sign && $payment = Payment::findByPayments($data['project'], $data['invoice'], 2)) {
            $payment->status = $payment->getStatus(ucfirst($data['status']));
            $payment->update();
            return true;
        }

        return false;
    }
}
