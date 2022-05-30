<?php


namespace App\Http\Controllers;
use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Models\Test; 
use App\Models\Content; 
use App\Models\Task; 
use Auth ;


class TaskController extends Controller
{
    public function index() { 
        $fields = Test::all(); 
        return Inertia::render('FertilizerScheduling' , ['fields' => $fields ]);
    }

    public function save(Request $request) { 

        $task = Task::create([
            'field_name' => $request->fieldName,
            'deadline' => $request->scheduledDate,
            'remarks' => $request->remarks
        ]);
        
        return redirect('FertilizerScheduling')->with('message','Task has been successfully saved');

    }
}
