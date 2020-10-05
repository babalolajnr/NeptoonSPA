<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use  Intervention\Image\Facades\Image;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getAuthenticatedUser()
    {
        $user = Auth::user();
        return response()->json([
            $user
        ], 200);
    }

    public function UpdateUser(Request $request, $id)
    {
        // $user_id = Auth::user()->id;
        
        $this->validate($request, array(
            'firstName' => 'required|string',
            'lastName' => 'required|string',
            'username' => 'required',
            'location' => 'required',
            'bio' => 'required',
            'skills' => 'required',
            'headline' => 'required',
            'experience' => 'required'
        ));

        //update post
        Auth::user()->where("id", $id)->update([
            'firstName' => $request->firstName,
            'lastName' =>  $request->lastName,
            'username' =>  $request->username,
            'location' =>  $request->location, 
            'bio' =>  $request->bio,
            'skills' =>  $request->skills,
            'headline' =>  $request->headline,
            'experience' =>  $request->experience
        ]);

        return response()->json([
            'success' => 'User Profile Updated Successfully!'
        ], 200);

    }

    public function updateAvatar(Request $request, $id) 
    {
        $this->validate($request, array(
            'avatar' => 'required|image|mimes:jpeg,png,jpg'
        ));

        // Process the image and resize to 750x450
        $request->avatar = 'storage/avatars/' . $request->file('avatar')->getClientOriginalName();
        $avatar = Image::make($request->file('avatar')->getRealPath())->fit(128,128);
        $avatar->save($request->avatar);

        $user = User::find($id);
        $user->update([
            'avatar' => $request->avatar
        ]);
        return response()->json([
            'success' => 'User Avatar Updated Successfully!'
        ], 200);

    }
}
