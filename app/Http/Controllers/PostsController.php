<?php

namespace App\Http\Controllers;

use App\Category;
use App\Post;
use Carbon\Carbon;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use  Intervention\Image\Facades\Image;

class PostsController extends Controller
{
   
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->title);
        // validation
        $this->validate($request, array(
            'title' => 'required|min:2',
            'body' => 'required',
            'category' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg',
            'tags' => 'required',
        ));

        // Process the image and resize to 750x450
        $request->image = 'storage/uploads/' . $request->file('image')->getClientOriginalName();
        $image = Image::make($request->file('image')->getRealPath())->fit(750,450);
        $image->save($request->image);

        //Get Category from database
        $category_id = Category::where('name', $request->category)->get('id');

        Auth::user()->post()->create([
            'title' => $request->get('title'),
            'body' => $request->get('body'),
            'category_id' => $category_id[0]->id,
            'tags' => $request->get('tags'),
            'published' => false,
            'featured' => false,
            'slug' => SlugService::createSlug(Post::class, 'slug', $request->title),
            'image' => $request->image
        ]);

        return response()->json([
            'success' => 'Post Created Successfully'], 200);
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * get all the info related to the selected id
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // dd($id);
        $post = Post::find($id);
        $categories = Category::all();
        return response()->json([$post, $categories], 200);
    
    }

    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);
        $post->delete();

        return response()->json([
            'success' => 'Post Deleted Successfully!'
        ], 200);
    }

    //Get drafted posts
    public function getDrafts(){
        $drafts = Post::select('id', 'title', 'category_id', 'image', 'created_at' )
                                ->where('published', 0)->with(array('category'=>function($query){
                                    $query->select('id', 'name');
                                }))
                                ->orderBy('created_at', 'desc')->paginate(10);
        
        return response()->json([$drafts], 200);
    }

    // Publish Post
    public function publish($id) {
      
        $published = Carbon::now();
        $published = $published->toDateTimeString();

        Post::where("id", $id)->update([
            "published" => 1,
            "published_at" => $published
        ]);

        return response()->json([
            'success' => 'Post Published Successfully!'
        ], 200);
    }

     //Display Live Posts
     public  function getLivePosts() {
        // $livePosts = Post::where('published', 1)->orderBy('published_at', 'desc')->get();
        // $livePosts = Post::select('id', 'title', 'category_id', 'image', 'published_at' )->where('published', 0)->orderBy('published_at', 'desc')->paginate(5);
        $livePosts = Post::select('id', 'title', 'category_id', 'image', 'published_at' )
                                ->where('published', 1)->with(array('category'=>function($query){
                                    $query->select('id', 'name');
                                }))
                                ->orderBy('created_at', 'desc')->paginate(10);
        
        return response()->json([$livePosts], 200);  
        
    }
}
