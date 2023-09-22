<?php

namespace App\Http\Controllers\Api\Gate;

use App\Http\Controllers\Controller;
use App\Models\Cico;
use App\Models\Transaction;
use App\Models\TransactionStevedor;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    //
    public function index(){
        
        $transactions = Transaction::where('status',1)->count();
        $stevedors = TransactionStevedor::where('cico_status',0)->count();

        $array[] = array(
            'transactions' => intval($transactions),
            'stevedors_in' => intval($stevedors),
        );

        return response([
            'home' => $array,
        ],200);

    }
}
