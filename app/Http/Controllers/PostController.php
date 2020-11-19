<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{

	public function list()
	{
		$list=Post::where('active', true)->orderBy('publication_date', 'desc')->get();

		return response()->json($list);
	}

	public function item($id)
	{
		$post=Post::find($id);

		return response()->json($post);
	}	

}
