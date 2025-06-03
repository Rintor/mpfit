<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @mixin IdeHelperOrder
 */
class Order extends Model
{
    protected $fillable = [
        'customer_fullname',
        'status',
        'customer_comment',
        'product_id',
        'product_count',
    ];

    protected CONST STATUSES = [
        'new' => 'Новый',
        'completed' => 'Выполнен',
    ];

    public static function getStatuses(): array
    {
        return self::STATUSES;
    }

    public static function getStatusByKey($key): ?string
    {
        return self::STATUSES[$key] ?? null;
    }

    public function getStatus(): ?string
    {
        return self::getStatusByKey($this->status);
    }

    public function getSum(): ?float
    {
        return round(optional($this->product)->price * $this->product_count, 2);
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
