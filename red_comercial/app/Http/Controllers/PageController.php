<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Page;
use Illuminate\Support\Facades\DB;

class PageController extends Controller
{
     //
     public function index(){
        $page = Page::all();
        
        return $page;
    }
}
