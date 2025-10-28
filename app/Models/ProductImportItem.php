<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductImportItem extends Model
{
    //
    protected $fillable = ['product_import_id', 'product_id', 'quantity', 'import_price', 'subtotal'];

    // Một dòng thuộc về phiếu nhập hàng
    public function import()
    {
        return $this->belongsTo(ProductImport::class, 'product_import_id');
    }

    // Một dòng chi tiết thuộc về sản phẩm cụ thể
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    // Getter tự động tính tổng tiền nếu muốn
    public function getSubtotalAttribute()
    {
        return $this->quantity * $this->import_price;
    }
}
