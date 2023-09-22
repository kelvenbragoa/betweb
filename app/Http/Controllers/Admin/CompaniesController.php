<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\User;
use Illuminate\Http\Request;

class CompaniesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $searchQuery = request('query');

            $companies = Company::query()
            ->when(request('query'),function($query,$searchQuery){
                $query->where('name','like',"%{$searchQuery}%")->orWhere('email','like',"%{$searchQuery}%")->orWhere('username','like',"%{$searchQuery}%");
            })
            ->with('user')
            ->orderBy('name','asc')
            ->paginate(10);


            return $companies;
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

        $request->validate([
            'companyname' =>'required',
            'nuit' =>'required',
            'address' =>'required',
            'email' =>'required',
            'name' =>'required',
            'username' =>'required|unique:users',
            'role_id' =>'required',
            'email' =>'required|unique:users,email',
            'password' =>'required|min:8',
        ]);

      


        $user = User::create([
            'name' => $data['name'],
            'username' => strtolower($data['username']),
            'role_id' => $data['role_id'],
            'email' => strtolower($data['email']),
            'password' => bcrypt($data['password']),
        ]);

       
            $company = Company::create([
                'name' => $data['companyname'],
                'nuit' => $data['nuit'],
                'address' => $data['address'],
                'user_id'=>$user->id
            ]);
        

        return $user;


    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //

        $company = Company::with('user')->find($id);

        return $company;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $company = Company::with('user')->find($id);
       
        

        return [
            'company'=>$company,
            ];
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //

        $data = $request->all();
        $company = Company::find($id);

        $request->validate([
            'companyname' =>'required',
            'nuit' =>'required',
            'address' =>'required',
        ]);

        

        $company->update([
            'name' => $data['companyname'],
            'nuit' => $data['nuit'],
            'address' => $data['address'],
        ]);

        return $company;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $company = Company::find($id);
        $user = User::find($company->user_id);

       
        $company->delete();
        $user->delete();

        return response()->noContent();
    }
}
