<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

use function Ramsey\Uuid\v1;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return response()->json($categories);
    }


    public function category()
    {
        $categories = Category::all();
    
        return view('category', ['categories' => $categories]);
    }

    public function show($id)
    {
        $categories = Category::find($id);
        return response()->json($categories);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $category = new Category();
        $category->name = $request->name;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);
            $category->image = $imageName;
        }

        $category->save();

        return response()->json($category, 201);
    }

    public function update(Request $request, Category $category)
    {
        $this->validate($request, [
            'name' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $category->name = $request->name;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);
            $category->image = $imageName;
        }

        $category->save();

        return response()->json($category, 200);
    }

    public function destroy(Category $category)
    {
        // Eliminar la imagen de la categoría si existe
        if ($category->image) {
            $imagePath = public_path('images/' . $category->image);
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }
    
        $category->delete();
    
        return response()->json(null, 204);
    }
    
}
