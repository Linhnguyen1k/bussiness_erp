<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Supplier extends Model
{
    //
    use HasFactory, SoftDeletes;
    protected $fillable = ['name', 'contact_name', 'phone', 'email', 'address'];
    // Một nhà cung cấp có thể có nhiều phiếu nhập hàng
    public function productImports()
    {
        return $this->hasMany(ProductImport::class);
    }

    // Một nhà cung cấp có thể có nhiều hợp đồng nhập
    public function contracts()
    {
        return $this->hasMany(ImportContract::class);
    }

}
