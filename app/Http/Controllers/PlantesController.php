<?php

namespace App\Http\Controllers;

use App\Models\plantes;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreplantesRequest;
use App\Http\Requests\UpdateplantesRequest;

class PlantesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $plantes = plantes::all();

        return response()->json([
            'status' => 'success',
            'plante' => $plantes
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreplantesRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreplantesRequest $request)
    {
        //
        DB::table('plantes')->insert([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'category_id' => $request->category_id,
            'user_id' => Auth::user()->id,
            'created_at' => Carbon::now(),
        ]);

        return response()->json([
            'message' => 'Successfully'
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\plantes  $plantes
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $is_find = plantes::find($id);

        if (!$is_find) {
            return response()->json([
                'message' => 'Plante not found'
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'plante' => $is_find
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\plantes  $plantes
     * @return \Illuminate\Http\Response
     */
    public function edit(plantes $plantes)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateplantesRequest  $request
     * @param  \App\Models\plantes  $plantes
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateplantesRequest $request, $id)
    {
        //
        $is_find = plantes::find($id);

        if ($is_find) {
            $is_find->name = $request->name;
            $is_find->user_id = Auth::user()->id;
            $is_find->description = $request->description;
            $is_find->price = $request->price;
            $is_find->category_id = $request->category_id;
            $is_find->created_at = Carbon::now();
            $is_find->update();


            return response()->json([
                'message' => 'Plante Updated Successfull'
            ]);
        } else {

            return response()->json([
                'message' => 'No Records Found'
            ], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\plantes  $plantes
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $is_deleted = DB::table('plantes')->where('id', $id)->delete();

        if ($is_deleted) {
            return response()->json([
                'message' => 'Plante deleted successfully'
            ], 200);
        } else {
            return response()->json([
                'message' => 'No Plante Found'
            ], 404);
        }
    }
}
