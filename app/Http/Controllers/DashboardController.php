<?php

namespace App\Http\Controllers;
use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Models\Test; 
use App\Models\Content; 
use App\Models\Task; 

use Auth ;
use Illuminate\Support\Facades\Http;
use Carbon\Carbon; 


class DashboardController extends Controller
{
    public function index() { 

        $tests = Test::all();
        $lat = '14.3407';
        $lon = '120.9825'; 
        $key = 'd66d9d14005cb56a56c9bd5987eb9a8d';


        $task_today = Task::all()->where('deadline' , date("Y-m-d"));
        $pending_tasks = Task::all()->where('status','pending');

        $weather = json_decode(file_get_contents("http://api.openweathermap.org/data/2.5/forecast?lat=14.3407&lon=120.9825&appid=d66d9d14005cb56a56c9bd5987eb9a8d&cnt=6"));
        $today = $weather->list[0] ;

    

        return Inertia::render('Dashboard' ,[
            'weather' => $weather ,
            'taskToday' => $task_today ,
            'pendingTasks' => $pending_tasks 
        ]); 
    }

}
