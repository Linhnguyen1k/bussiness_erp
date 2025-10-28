<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductStock extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'quantity',
        'warehouse',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    // 🔹 Cộng / trừ tồn kho
    public function scopeIncrease($query, $productId, $qty)
    {
        $stock = $query->firstOrCreate(['product_id' => $productId]);
        $stock->increment('quantity', $qty);
    }

    public function scopeDecrease($query, $productId, $qty)
    {
        $stock = $query->firstOrCreate(['product_id' => $productId]);
        $stock->decrement('quantity', $qty);
    }
}
