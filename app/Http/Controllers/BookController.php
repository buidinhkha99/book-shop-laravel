<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $book =  Book::orderBy('name', 'asc')
            ->get();
        return response()->json([
            'total' => 10,
            'data' => $book
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

        $book = new Book;
        $book->id = Str::uuid()->toString();
        $book->name = $request->input('name');
        $book->quantily = $request->input('quantily');
        $book->image = $request->input('image');
        $book->description = $request->input('description');
        $book->price = $request->input('price');

        try {
            $book->save();
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
     * 
     *
     * @param  string $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $book = Book::find($id);
        } catch (\Illuminate\Database\QueryException $exception) {
            $errorInfo = $exception->errorInfo;
            return response()->json([
                'error' => $errorInfo
            ], 500);
        }
        return response()->json([
            'data' => $book
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
        $book = Book::find($id);
        $book->name = $request->input('name');
        $book->quantily = $request->input('quantily');
        $book->image = $request->input('image');
        $book->description = $request->input('description');
        $book->price = $request->input('price');

        try {
            $book->save();
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
     * @param  string $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $book = Book::find($id);
        try {
            $book->delete();
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
