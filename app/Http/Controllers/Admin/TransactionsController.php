<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Models\TypeOperation;
use Illuminate\Http\Request;

class TransactionsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $searchQuery = request('query');

            $transactions = Transaction::query()
            ->when(request('query'),function($query,$searchQuery){
                $query->where('name','like',"%{$searchQuery}%");
            })
            ->with('company')
            ->with('stevedors')
            ->orderBy('end_date','desc')
            ->paginate(10);


            return $transactions;
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
        $transaction = Transaction::with('company')->with('stevedors.stevedor')->find($id);
        $typeoperations = TypeOperation::orderBy('name','asc')->get();
       
        

        return [
            'transaction'=>$transaction,
            'typeoperations'=>$typeoperations
            ];
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //

        $data = $request->all();

        $transaction = Transaction::find($id);

        $request->validate([
            'start_date' =>'required',
            'end_date' =>'required',
            'status' =>'required',
            'type_operation_id' =>'required',
        ]);

        

        $transaction->update([
            'start_date' => $data['start_date'],
            'end_date' => $data['end_date'],
            'status' => $data['status'],
            'type_operation_id' => $data['type_operation_id'],
        ]);

        return $transaction;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $transaction = Transaction::find($id);

        $transaction->delete();

        return response()->noContent();
    }
}
