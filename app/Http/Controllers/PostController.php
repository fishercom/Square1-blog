<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Post;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{

	public function list(Request $request)
	{
		$list=Post::select(DB::raw('users.name as author'), 'posts.id', 'posts.title', DB::raw('SUBSTRING(posts.description, 1, 255) as description'), 'posts.publication_date')
			->join('users', function($join) {
            	$join->on('posts.user_id', '=', 'users.id');
	        })
            ->where('posts.active', true)->orderBy('posts.publication_date', 'desc')
            //->take(15)
            ->get();

		return response()->json($list);
    }

	public function userposts()
	{
		$user = Auth::user();

        $list=Post::select(DB::raw('users.name as author'), 'posts.id', 'posts.title', DB::raw('SUBSTRING(posts.description, 1, 255) as description'), 'posts.publication_date')
			->join('users', function($join) {
            	$join->on('posts.user_id', '=', 'users.id');
            })
            ->where('user_id', $user->id)
            ->where('posts.active', true)->orderBy('posts.publication_date', 'desc')
            ->get();

		return response()->json($list);
    }

	public function item($id)
	{
		//$post=Post::find($id);
		$post=Post::select(DB::raw('users.name as author'), 'posts.id', 'posts.title', DB::raw('SUBSTRING(posts.description, 1, 255) as description'), 'posts.publication_date')
			->join('users', function($join) {
            	$join->on('posts.user_id', '=', 'users.id');
	        })
			->where('posts.id', $id)->first();

		return response()->json($post);
	}

    public function store(Request $request)
    {
        $v = Validator::make($request->all(), [
            'title' => 'required',
            'description' => 'required',
            'publication_date'  => 'required',
        ]);
        if ($v->fails())
        {
            return response()->json([
                'status' => 'error',
                'errors' => $v->errors()
            ], 422);
        }

		$user = Auth::user();

        $post = new Post;
        $post->title = $request->title;
        $post->description = $request->description;
        $post->publication_date = $request->publication_date;
		$post->active = true;
		$post->user_id = $user->id;
        $post->save();

        return response()->json(['status' => 'success'], 200);
    }

}
