<?php

namespace App\Http\Controllers;

use App\Models\category;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StorecategoryRequest;
use App\Http\Requests\UpdatecategoryRequest;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        //
        $category = category::all();

        return response()->json([
            'status' => 'success',
            'category' => $category
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
     * @param  \App\Http\Requests\StorecategoryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorecategoryRequest $request)
    {
        //
        $this->authorize('create', category::class);
        DB::table('categories')->insert([
            'name' => $request->name,
            'user_id' => Auth::user()->id,
            'created_at' => Carbon::now(),
        ]);

        return response()->json([
            'message' => 'Category Successfully Added'
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\category  $category
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $is_find = category::find($id);

        if (!$is_find) {
            return response()->json([
                'message' => 'category not found'
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'category' => $is_find
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatecategoryRequest  $request
     * @param  \App\Models\category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatecategoryRequest $request, $category)
    {
        //
        $categories = category::find($category);
        $user = Auth::user();
        $this->authorize('update', [$user, $categories]);
        // if ($user->hasDirectPermission('edit-plante')  && $user->id == $categories->user_id)
            if (null != $categories) {
                $categories->name = $request->name;
                $categories->user_id = Auth::user()->id;
                $categories->description = $request->description;
                $categories->price = $request->price;
                $categories->category_id = $request->category_id;
                $categories->created_at = Carbon::now();
                $categories->update();


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
     * @param  \App\Models\category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $this->authorize('delete', category::class);
        $is_deleted = DB::table('categories')->where('id', $id)->delete();

        if ($is_deleted) {
            return response()->json([
                'message' => 'Category deleted successfully'
            ], 200);
        } else {
            return response()->json([
                'message' => 'No Plante Found'
            ], 404);
        }
    }
}
