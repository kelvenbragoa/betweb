<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function company(){
        return $this->hasOne('App\Models\Company', 'id', 'company_id');
    }

    public function operation(){
        return $this->hasOne('App\Models\TypeOperation', 'id', 'type_operation_id');
    }

    public function stevedors(){
        return $this->hasMany('App\Models\TransactionStevedor','transaction_id','id');
    }
}
