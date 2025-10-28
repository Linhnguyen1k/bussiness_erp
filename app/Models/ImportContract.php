<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ImportContract extends Model
{
    //
    protected $table = 'import_contracts';
    protected $fillable = ['supplier_id', 'contract_code', 'signed_date', 'delivery_expected', 'total_estimated', 'payment_term_id', 'status', 'file_path'];

    // Một hợp đồng nhập thuộc 1 nhà cung cấp
    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    // Một hợp đồng nhập có điều khoản thanh toán
    public function paymentTerm()
    {
        return $this->belongsTo(PaymentTerm::class);
    }
}
