<?php

namespace App\Http\Controllers;
use Inertia\Inertia;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function index() { 
        return Inertia::render('PerformTest'); 
    }

    public function save(Request $request) {
        dump($request->all());
        return $request->all();
    }
}
