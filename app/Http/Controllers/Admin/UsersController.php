<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $searchQuery = request('query');

            $users = User::query()
            ->when(request('query'),function($query,$searchQuery){
                $query->where('name','like',"%{$searchQuery}%")->orWhere('email','like',"%{$searchQuery}%")->orWhere('username','like',"%{$searchQuery}%");
            })
            ->with('role')
            ->orderBy('name','asc')
            ->paginate(10);


            return $users;
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
            'name' =>'required',
            'username' =>'required|unique:users',
            'role_id' =>'required',
            'email' =>'required|unique:users,email',
            'password' =>'required|min:8',
        ]);

        if($data['role_id']==2)
        {
            $request->validate([
                'companyname' =>'required',
                'nuit' =>'required',
                'address' =>'required',
            ]);
        }


        $user = User::create([
            'name' => $data['name'],
            'username' => strtolower($data['username']),
            'role_id' => $data['role_id'],
            'email' => strtolower($data['email']),
            'password' => bcrypt($data['password']),
        ]);

        if($data['role_id']==2)
        {
            $company = Company::create([
                'name' => $data['companyname'],
                'nuit' => $data['nuit'],
                'address' => $data['address'],
                'user_id'=>$user->id
            ]);
        }

        return $user;


    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //

        $user = User::with('role')->find($id);

        return $user;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $user = User::with('role')->find($id);
        $roles = Role::orderBy('name','asc')->get();
        

        return [
            'user'=>$user,
            'roles'=>$roles,
            ];
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //

        $data = $request->all();
        $user = User::find($id);

        $request->validate([
            'name' =>'required',
            'username' =>'required',
            'email' =>'required|unique:users,email,'.$user->id,
            'password' =>'sometimes|min:8',
        ]);

        

        $user->update([
            'name' => $data['name'],
            'username' => $data['username'],
            'email' => strtolower($data['email']),
            'password' => request('password') ? bcrypt($data['password']) : $user->password
        ]);

        return $user;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $user = User::find($id);

        if(Auth::user()->id == $user->id){
            return abort(402,'Erro') ;
        }
        $user->delete();

        return response()->noContent();
    }

}
