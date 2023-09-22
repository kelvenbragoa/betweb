<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TypeOperation;
use Illuminate\Http\Request;

class TypeOperationsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $searchQuery = request('query');

            $typeoperations = TypeOperation::query()
            ->when(request('query'),function($query,$searchQuery){
                $query->where('name','like',"%{$searchQuery}%");
            })
            ->orderBy('name','asc')
            ->paginate(10);


            return $typeoperations;
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
            
        ]);

      


        $typeoperation = TypeOperation::create([
            'name' => $data['name'],
            
          
        ]);

       
          
        

        return $typeoperation;


    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //

        $typeoperation = TypeOperation::find($id);

        return $typeoperation;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $typeoperation = TypeOperation::find($id);
       
        

        return [
            'typeoperation'=>$typeoperation,
            ];
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //

        $data = $request->all();

        $typeoperation = TypeOperation::find($id);

        $request->validate([
            'name' =>'required',
           
        ]);

        

        $typeoperation->update([
            'name' => $data['name'],
            
        ]);

        return $typeoperation;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $typeoperation = TypeOperation::find($id);

        $typeoperation->delete();

        return response()->noContent();
    }
}
