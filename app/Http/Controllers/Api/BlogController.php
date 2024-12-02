<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\blog\BlogResource;
use App\Models\Blog;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $blogs = Blog::paginate(15);

        return response()->json(BlogResource::collection($blogs), Response::HTTP_OK);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
            $data = $request->validate([
                'title' => 'required|string|min:3',
                'content' => 'required|string',
            ]);

            $data['user_id'] = auth()->user()->id;
            
            $blog = Blog::create($data);

            return response()->json(BlogResource::make($blog), Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(Blog $blog)
    {
        try {
            return response()->json(BlogResource::make($blog),Response::HTTP_OK);
        } catch(Exception $e){
            return response()->json(['message' => 'Error al hacer la operacion '. $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, blog $blog)
    {
        $request->validate([
            'title' => 'required|string|min:3',
            'content' => 'required|string',
        ]);
        
        $blog->update($request->all());

        return response()->json(BlogResource::make($blog), Response::HTTP_CREATED);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Blog $blog)
    {
        $blog->delete();
        return response()->noContent();
    }
}
