<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    public function store(Request $request)
    {

        $rules = [
            'name' => 'required|min:3|unique:categories'
        ];

        $customMessages = [
            'unique' => 'The category already exists.'
        ];

        $this->validate($request, $rules, $customMessages);
       
        auth()->user()->category()->create([
            'name' => $request->name
        ]);

        return response()->json([
            'success' => 'Category Created Successfully'], 200);
    }

    public function getCategories()
    {
        $categories = Category::get('name');
        return response()->json($categories, 200);

        
    }
}
