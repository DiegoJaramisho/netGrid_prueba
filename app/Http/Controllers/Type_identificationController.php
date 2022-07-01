<?php

namespace App\Http\Controllers;

use App\Models\Type_identification;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class Type_identificationController extends Controller
{
    public function filtro (Request $request)
    {
        try{
            $type = Type_identification::where([
                ['name', 'ilike', "%$request->name%"]
            ])->get();
            return response()->json($type);
        }catch (QueryException $e) {
            return response()->json([
                'status' => 'ERROR',
                'message' => $e->getMessage()
            ]);
        }
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Type_identification::paginate();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try{
            $existe = Type_identification::where('name',$request->name)->first();
            $type_id = Type_identification::create([
                'name' => $request->name,
                'status' => true
            ]);
            if($existe){
                return response()->json('este dato ya existe');
            }
            return response()->json(
                $type_id
            ,200);
        }catch (QueryException $e) {
            return response()->json([
                'status' => 'ERROR',
                'message' => $e->getMessage()
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
