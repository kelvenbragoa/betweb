<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Models\Stevedor;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CompanyDashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
       
        $stevedors = Stevedor::where('company_id',Auth::user()->company->id)->count();
        $transactions = Transaction::where('company_id',Auth::user()->company->id)->count();
        $transactions_pending= Transaction::where('status',0)->count();
        $transactions_ongoing= Transaction::where('status',1)->count();
        $transctions_expired = Transaction::where('end_date', '<' ,date('Y-m-d'))->count();


        
        return [
            'stevedors' => $stevedors,
            'transactions' => $transactions,
            'transactions_pending' => $transactions_pending,
            'transactions_ongoing' => $transactions_ongoing,
            'transctions_expired' => $transctions_expired,
        ];
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
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
