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

        return redirect()->back()->with('message','Task has been successfully saved'); 

    }

    public function removeTask(Request $request) { 

        $task = Task::findorfail($request->id);
        
        $task->delete() ;

        return redirect()->back()->with('message','Task Successfully Removed'); 
    }

    public function finishTask(Request $request) { 

        $task = Task::findorfail($request->id); 

        $task->status = 'finished' ; 

        $task->save(); 

        return redirect()->back()->with('message','Task Successfully Finished'); 

    }
}
