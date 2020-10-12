<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CosmosController extends Controller
{
    public function latestPosts()
    {
        $latestPosts =  Post::select('id', 'title', 'category_id', 'image', 'published_at', 'slug')
            ->where('published', 1)->with(array('category' => function ($query) {
                $query->select('id', 'name');
            }))
            ->orderBy('published_at', 'desc')->paginate(14);

        return response()->json([$latestPosts], 200);
    }
   
    public function topLatestPosts()
    {
        $topLatestPosts = Post::select('id', 'title', 'category_id', 'image', 'published_at', 'slug')
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
    public function singlePost($slug)
    {
        // $post = Post::find($slug);
        $post = Post::where('slug', $slug)->with('category')->first();
        // dd($slug);
        return response()->json($post, 200);
    }
    public function addView($id)
    {
        $post = Post::where('id', $id)->first();
        $post = $post->views();
        $post++;

        Post::where('id', $id)->update([
            'views' => $post
        ]);

        return response()->json('sucess', 200);
        
    }
}
