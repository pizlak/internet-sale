<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Order extends Model
{
    protected $fillable = [
        'user_id',
        'status'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class)
            ->withPivot('count');
    }

    public static function getFullPrice(Order $order): float
    {
        $order = self::where('id', $order->id)
            ->first();

        $price = 0;

        if (!empty($order->products)) {
            foreach ($order->products as $product) {
                $price += $product->price * $product->pivot->count;
            }
        }

        return $price ?? '';
    }
}

