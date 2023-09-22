<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Role;
use App\Models\Stevedor;
use App\Models\TypeOperation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GlobalController extends Controller
{
    //
    public function auxiliardata(){

        $roles = Role::orderBy('id','asc')->get();
       

        // $roles2 = $roles->except(1);

        return [
                'roles'=>$roles,
               
                ];
    }

    public function auxiliardatastevadors(){

        $companies = Company::orderBy('name','asc')->get();
       

        // $roles2 = $roles->except(1);

        return [
                'companies'=>$companies,
               
                ];
    }

    public function auxiliardatatransactions(){

        $stevedors = Stevedor::where('company_id',Auth::user()->company->id)->orderBy('name','asc')->get();
        $typeoperations = TypeOperation::orderBy('name','asc')->get();
       

        // $roles2 = $roles->except(1);

        return [
                'stevedors'=>$stevedors,
                'typeoperations'=>$typeoperations
               
                ];
    }

    

}
