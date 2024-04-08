<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function explore()
    {
        return view("pages.explore");
    }
}
