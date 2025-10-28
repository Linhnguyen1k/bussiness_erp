<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductImport extends Model
{
    //
    use HasFactory;
    protected $fillable = ['supplier_id','code', 'import_date', 'total_amount', 'note', 'created_by'];

    // Một phiếu nhập thuộc về một nhà cung cấp
    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    // Một phiếu nhập có nhiều dòng sản phẩm nhập
    public function items()
    {
        return $this->hasMany(ProductImportItem::class);
    }

    // Người tạo phiếu nhập
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
