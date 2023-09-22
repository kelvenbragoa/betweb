<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionStevedor extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function transaction(){
        return $this->hasOne('App\Models\Transaction', 'id', 'transaction_id');
    }

    public function stevedor(){
        return $this->hasOne('App\Models\Stevedor', 'id', 'stevedor_id');
    }
}
