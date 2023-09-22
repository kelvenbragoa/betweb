<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Models\TransactionStevedor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $searchQuery = request('query');

            $stevedors = Transaction::query()
            ->when(request('query'),function($query,$searchQuery){
                $query->where('name','like',"%{$searchQuery}%");
            })
            ->with('company')
            ->with('stevedors')
            ->where('company_id',Auth::user()->company->id)
            ->orderBy('end_date','asc')
            ->paginate(10);


            return $stevedors;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $data = $request->all();
        // dd($data);
       

        $request->validate([
            'start_date' =>'required',
            'end_date' =>'required',
            'type_operation_id' =>'required',
        ]);
        
        $counter = 0;
        $error = 0;
        $msg = '';

       

        foreach($data['stevedors'] as $item){


            $counter = $counter + count($item);

            if(count($item)>0){
                $transactionstevedors = TransactionStevedor::where('stevedor_id',$item['stevedor_id'])->get();
                foreach($transactionstevedors as $transactionstevedor){
                    if($transactionstevedor->transaction->status == 0 || $transactionstevedor->transaction->status == 1){
                        $error = $error + 1;
                        $msg = $msg.' '.$transactionstevedor->stevedor->name.',';
                    }
                }
            }
           
           
        }

        if($counter == 0){
            return response()->json([
                'message' => 'Adicione pelo menos 1 estivador para a requisição',
            ], 404);
        }

        if($error > 0 ){
            return response()->json([
                'message' => 'Não foi possivel porque os seguintes estivadores estão em guias ativas : '.$msg,
            ], 404);
        }
       

        $actualtransaction = Transaction::create([
            'start_date' => $data['start_date'],
            'end_date' => $data['end_date'],
            'type_operation_id' => $data['type_operation_id'],
            'status'=>0,
            'company_id' => Auth::user()->company->id
        ]);

        foreach($data['stevedors'] as $item){

            if(count($item)>0){

                $transactiostevedor = TransactionStevedor::create([
                    'transaction_id'=> $actualtransaction->id,
                    'stevedor_id'=> $item['stevedor_id']
                ]);
              
            }
           
           
        }



       
          
        

        return $actualtransaction;


    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //

        $transaction = Transaction::with('company')->with('stevedors.stevedor')->find($id);

        return $transaction;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $transaction = Transaction::with('company')->find($id);
       
        

        return [
            'transaction'=>$transaction,
            ];
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //

        $data = $request->all();

        $stevedor = Transaction::find($id);

        $request->validate([
            'name' =>'required',
            'contact' =>'required',
            'document' =>'required',
        ]);

        

        $stevedor->update([
            'name' => $data['name'],
            'contact' => $data['contact'],
            'document' => $data['document'],
        ]);

        return $stevedor;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $stevedor = Transaction::find($id);

        $stevedor->delete();

        return response()->noContent();
    }
}
