<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentTerm extends Model
{
    //
    protected $fillable = ['name', 'description', 'days', 'is_default'];
    public function contracts()
    {
        return $this->hasMany(ImportContract::class);
    }
    
}
