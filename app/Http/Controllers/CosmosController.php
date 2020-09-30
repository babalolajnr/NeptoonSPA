<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

class CosmosController extends Controller
{
    public function latestPosts()
    {
        $latestPosts =  Post::select('id', 'title', 'category_id', 'image', 'published_at')
            ->where('published', 1)->with(array('category' => function ($query) {
                $query->select('id', 'name');
            }))
            ->orderBy('created_at', 'desc')->paginate(8);

        return response()->json([$latestPosts], 200);
    }
}
