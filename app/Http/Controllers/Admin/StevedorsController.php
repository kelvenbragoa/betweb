<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Stevedor;
use Illuminate\Http\Request;

class StevedorsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $searchQuery = request('query');

            $stevedors = Stevedor::query()
            ->when(request('query'),function($query,$searchQuery){
                $query->where('name','like',"%{$searchQuery}%");
            })
            ->with('company')
            ->orderBy('name','asc')
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

        $request->validate([
            'name' =>'required',
            'contact' =>'required',
            'document' =>'required',
            'company_id' =>'required',
        ]);

      


        $stevedor = Stevedor::create([
            'name' => $data['name'],
            'contact' => $data['contact'],
            'document' => $data['document'],
            'company_id' => $data['company_id'],
          
        ]);

       
          
        

        return $stevedor;


    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //

        $stevedor = Stevedor::with('company')->find($id);

        return $stevedor;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $stevedor = Stevedor::with('company')->find($id);
       
        

        return [
            'stevedor'=>$stevedor,
            ];
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //

        $data = $request->all();

        $stevedor = Stevedor::find($id);

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
        $stevedor = Stevedor::find($id);

        $stevedor->delete();

        return response()->noContent();
    }
}
