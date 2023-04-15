<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\areas;

class GuestController extends Controller
{
    	public function show(areas $area)
	{

		return view('areas.show', compact('area'));


	}
}
