<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Stevedor;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $users = User::count();
        $companies = Company::count();
        $stevedors = Stevedor::count();
        $transactions = Transaction::count();
        $transactions_pending= Transaction::where('status',0)->count();
        $transactions_ongoing= Transaction::where('status',1)->count();
        $transctions_expired = Transaction::where('end_date', '<' ,date('Y-m-d'))->count();
        $stevedors_with_flag = Stevedor::count();

        
        return [
            'users' => $users,
            'companies' => $companies,
            'stevedors' => $stevedors,
            'transactions' => $transactions,
            'transactions_pending' => $transactions_pending,
            'transactions_ongoing' => $transactions_ongoing,
            'transctions_expired' => $transctions_expired,
            'stevedors_with_flag' => $stevedors_with_flag,
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
