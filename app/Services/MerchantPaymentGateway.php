<?php

namespace App\Services;

use App\Contracts\PaymentGateway;
use App\Models\Payment;

class MerchantPaymentGateway implements PaymentGateway
{
    public function check($data, $sign = null)
    {
        $sign = $data['sign'];
        $filteredArray = array_diff_key($data, ['sign' => '']);
        arsort($filteredArray);
        $generated_sign = hash('sha256', implode(':', $filteredArray) . '.app_key');
        if ($sign === $generated_sign && $payment = Payment::findByPayments($data['merchant_id'], $data['payment_id'], 1)) {
            $payment->status = $payment->getStatus(ucfirst($data['status']));
            $payment->update();
            return true;
        }

        return false;
    }
}
