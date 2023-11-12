<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    const TYPE_MERCHANT = 1;
    const TYPE_APP = 2;

    const STATUS_CREATED = 1;
    const STATUS_INPROGRESS = 2;
    const STATUS_PAID = 3;
    const STATUS_EXPIRED = 4;
    const STATUS_REJECTED = 5;

    public static function findByPayments($merchant_id, $payment_id, $type)
    {
        return Payment::query()
            ->where(['type' => $type, 'merchant_id' => $merchant_id, 'payment_id' => $payment_id])
            ->first();
    }

    public static function getTypes()
    {
        return [
            self::TYPE_MERCHANT => 'Merchant',
            self::TYPE_APP => 'App',
        ];
    }

    public function getType(): string
    {
        return self::getTypes()[$this->type];
    }

    public static function getAppStatuses()
    {
        return [
            self::STATUS_CREATED => 'Created',
            self::STATUS_INPROGRESS => 'Inprogress',
            self::STATUS_PAID => 'Paid',
            self::STATUS_EXPIRED => 'Expired',
            self::STATUS_REJECTED => 'Rejected',
        ];
    }

    public static function getMerchantStatuses()
    {
        return [
            self::STATUS_CREATED => 'New',
            self::STATUS_INPROGRESS => 'Pending',
            self::STATUS_PAID => 'Completed',
            self::STATUS_EXPIRED => 'Expired',
            self::STATUS_REJECTED => 'Rejected',
        ];
    }

    public function getStatus($status): string
    {
        $method_name = 'get'.self::getTypes()[$this->type].'Statuses';
        return array_search($status, self::$method_name());
    }
}
