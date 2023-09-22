<?php

namespace App\Http\Controllers\Api\Gate;

use App\Http\Controllers\Controller;
use App\Models\Stevedor;
use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    //

  
        public function index(){
        

            return response([
                'transactions' => Transaction::where('status',1)->with('company')->with('operation')->orderBy('end_date', 'desc')->get()
            ],200);
    
        }

        public function getdetails($id){
           
                $stevedor = Stevedor::find($id);
        
                return response([
        
                    'name' => $stevedor->name,
                    'document' => $stevedor->document,
                    'contact' => $stevedor->contact,
                    'company' => $stevedor->company->name
                   
                ], 200);
        
            
        }
    
}
