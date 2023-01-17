<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Campground;
use App\Models\Comment;
use App\Models\User;
use Auth;

class UserController extends Controller
{
    function landingpage(){
        return view('landingpage');
    }

    function Campgrounds(){
        $campgrounds = Campground::all();
        return view('campgrounds', ['campgrounds'=>$campgrounds]);
    }

    function Campgrounddetail($id){
        $campground = Campground::find($id);
        $comments = Comment::where('campId',$id)->get();
        $userId = Auth::id();
        return view('campgrounds-detail',['campgroundDetail'=>$campground,'comments'=>$comments,'userid'=>$userId]);
    }

    function createCampground(){
        return view('addNewCampground');
    }

    function logout(){
        return redirect('/');
    }

    function editCampground($id){
        $campground = Campground::find($id);
        return view('edit-campground',['campground'=>$campground]);
    }
    

    function storeCampground(){

        $campground = new Campground();
        $campground->name = \request("name");
        $campground->description = \request("description");
        $campground->imageUrl = \request("image");
        $campground->money = \request("cost");
        $campground->userId = Auth::id();
        $campground->save();

        return redirect('campgrounds');
    }

    function editCampgroundDetail($id){
        $campground = Campground::find($id);
        $campground->name = \request("edit_name");
        $campground->description = \request("edit_description");
        $campground->imageUrl = \request("edit_image");
        $campground->save();
        $comments = Comment::where('campId',$id)->get();
        $userId = Auth::id();
        return view('campgrounds-detail',['campgroundDetail'=>$campground,'comments'=>$comments,'userid'=>$userId]);
    }

    function deleteCampground($id){
        $campground = Campground::find($id);
        $campground->delete();
        $campgrounds = Campground::all();
        return view('campgrounds', ['campgrounds'=>$campgrounds]);
    }

    function addComment($id){
        $userId = Auth::id();
        $user = User::find($userId);
        $comment = new Comment();
        $comment->comment = \request('comment');
        $comment->campId = $id;
        $comment->userId = $userId;
        $comment->username = $user->name;
        $comment->save();

        return \response($comment);
        // $campground = Campground::find($id);
        // $comments = Comment::where('campId',$id)->get();
        // return redirect("/campground/campground-detail/".$id,302,['campgroundDetail'=>$campground,'comments'=>$comments,'userid'=>$userId]);

    }

    function hello(){
        return "Hello";
    }
};

