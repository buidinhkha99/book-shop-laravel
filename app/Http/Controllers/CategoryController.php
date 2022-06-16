<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $pageNumber = 1;
        if ($request->has('page')) {
            $pageNumber = $request->input('page');
        }
        try {
            $categories = Category::paginate(2, ['*'], 'page', $pageNumber);
        } catch (\Illuminate\Database\QueryException $exception) {
            $errorInfo = $exception->errorInfo;
            return response()->json([
                'error' => $errorInfo
            ], 500);
        }

        return response()->json([
            'total' => 10,
            'data' => $categories
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();

        $category = new Category;
        $category->id = Str::uuid()->toString();
        $category->name = $request->input('name');
        $category->quantily = $request->input('quantily');
        $category->image = $request->input('image');
        $category->description = $request->input('description');
        $category->price = $request->input('price');

        try {
            $category->save();
        } catch (\Illuminate\Database\QueryException $exception) {
            $errorInfo = $exception->errorInfo;
            return response()->json([
                'error' => $errorInfo
            ], 500);
        }

        return response()->json([
            'message' => 'Save successful'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $category = Category::find($id);
        } catch (\Illuminate\Database\QueryException $exception) {
            $errorInfo = $exception->errorInfo;
            return response()->json([
                'error' => $errorInfo
            ], 500);
        }

        $category->id;
        return response()->json([
            'data' => $category
        ]);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, string $id)
    {
        $category = Category::find($id);
        $category->name = $request->input('name');
        try {
            $category->save();
        } catch (\Illuminate\Database\QueryException $exception) {
            $errorInfo = $exception->errorInfo;
            return response()->json([
                'error' => $errorInfo
            ], 500);
        }
        return response()->json([
            'message' => 'Update successful'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::find($id);
        try {
            $category->delete();
        } catch (\Illuminate\Database\QueryException $exception) {
            $errorInfo = $exception->errorInfo;
            return response()->json([
                'error' => $errorInfo
            ], 500);
        }
        return response()->json([
            'message' => 'Delete successful'
        ]);
    }
}
