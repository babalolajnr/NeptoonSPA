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
            ->orderBy('published_at', 'desc')->paginate(11);

        return response()->json([$latestPosts], 200);
    }

    public function topLatestPosts()
    {
        $topLatestPosts = Post::select('id', 'title', 'category_id', 'image', 'published_at')
            ->where('published', 1)->with(array('category' => function ($query) {
                $query->select('id', 'name');
            }))
            ->orderBy('published_at', 'desc')->limit(3)->get();

        return response()->json($topLatestPosts, 200);
    }

    public function featuredPosts()
    {
        $featuredPosts = Post::select('id', 'title', 'image', 'category_id')
            ->where('featured', 1)->with(array('category' => function ($query) {
                $query->select('id', 'name');
            }))->orderBy('featured_at', 'desc')
            ->limit(3)->get();

        return response()->json($featuredPosts, 200);
    }
}
