<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function filtro (Request $request)
    {
        try{
            $user = User::with(['type_identifications' => function ($query) {
                $query->select('id','name');
            }])->when($request->user != null, function ($query) use ($request) {
                $query->where([
                    ['user', 'ilike', '%' . $request->user . '%'],
                ]);
            })->when($request->name != null, function ($query) use ($request) {
                $query->where([
                    ['name', 'ilike', '%' . $request->name . '%'],
                ]);
            })->when($request->lastname != null, function ($query) use ($request) {
                $query->where([
                    ['lastname', 'ilike', '%' . $request->lastname . '%'],
                ]);
            })->when($request->identification != null, function ($query) use ($request) {
                $query->where('identification',$request->identification);
            })->when($request->email != null, function ($query) use ($request) {
                $query->where('email',$request->email);
            })->when($request->type_identifications_id != null, function ($query) use ($request) {
                $query->where('type_identifications_id',$request->type_identifications_id);
            })->paginate(10);

            return response()->json([
                'registro' => $user
            ],200);
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
        return response()->json([
            User::with(['type_identifications' => function ($query) {
                $query->select('id','name');
            }])->paginate()
        ],200);
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
            $user =  User::create([
                'user' => $request->user,
                'name' =>  $request->name,
                'lastname' =>  $request->lastname,
                'type_identifications_id' => $request->type_identifications_id,
                'identification' =>  $request->identification,
                'day_of_birth' => $request->day_of_birth,
                'email' => $request->email,
                'password' => $request->password,
            ]);
            return response()->json([
                'registro' => $user
            ],200);

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
        try{
            $user = User::where('id',$id)->with(['type_identifications' => function ($query) {
                $query->select('id','name');
            }])->first();
            if(!$user){
                return response()->json([
                    'message' => 'No se encontro el registro'
                ],200);
            }

            return response()->json([
                'registro' => $user
            ],200);



        }catch (QueryException $e) {
            return response()->json([
                'status' => 'ERROR',
                'message' => $e->getMessage()
            ]);
        }
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
        try{
            $user = User::where('id',$id)->with(['type_identifications' => function ($query) {
                $query->select('id','name');
            }])->first();
            if(!$user){
                return response()->json([
                    'message' => 'No se encontro el registro'
                ],200);
            }
            $user->update([
                'user' => $request->user,
                'name' =>  $request->name,
                'lastname' =>  $request->lastname,
                'type_identifications_id' => $request->type_identifications_id,
                'identification' =>  $request->identification,
                'day_of_birth' => $request->day_of_birth,
                'email' => $request->email,
                'password' => $request->password,
            ]);

            return response()->json([
                'registro' => $user
            ],200);



        }catch (QueryException $e) {
            return response()->json([
                'status' => 'ERROR',
                'message' => $e->getMessage()
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            $user = User::where('id',$id)->first();
            if(!$user){
                return response()->json([
                    'message' => 'No se encontro el registro'
                ],200);
            }
            $user->delete();
            return response()->json([
                'registro' => 'El registro se ha eliminado correctamente'
            ],200);



        }catch (QueryException $e) {
            return response()->json([
                'status' => 'ERROR',
                'message' => $e->getMessage()
            ]);
        }
    }
}
