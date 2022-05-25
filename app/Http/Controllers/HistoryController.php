<?php

namespace App\Http\Controllers;
use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Models\Test; 
use App\Models\Content; 
use Auth ;



class HistoryController extends Controller
{
    public function getAllHistoryData() { 
        $tests =  Test::all(); 

        foreach($tests as $test) { 
            dump($test->contents); 
        }
    }

}
