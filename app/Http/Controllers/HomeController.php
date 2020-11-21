<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Jobs\RecievePosts;


class HomeController extends Controller
{
	public function index(Request $request)
	{

		RecievePosts::dispatch();

		return view('index');
	}
}
