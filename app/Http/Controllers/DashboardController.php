<?php

namespace App\Http\Controllers;
use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Models\Test; 
use App\Models\Content; 
use Auth ;



class DashboardController extends Controller
{
    public function index() { 
        $tests = Test::all(); 

        return Inertia::render('Dashboard' ,['tests' => $tests]); 
    }

}
