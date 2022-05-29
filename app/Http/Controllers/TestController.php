<?php

namespace App\Http\Controllers;
use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Service\TestService; 
use App\Models\Test; 
use App\Models\Content; 
use Auth ;



class TestController extends Controller
{
    public function index() { 
        return Inertia::render('PerformTest'); 
    }

    public function update($id) { 
        $test = Test::find($id); 
        return Inertia::render('PerformUpdateTest' , ['test_id' => $test->id ,'prevResults' => $test->contents]); 
    }

    public function save(Request $request , TestService $test_service  ) {

        //save to db 

        if(!$request->test_id) { 
            $test = Test::create([
                'user_id' => Auth::user()->id,
                'name' => $request->title 
            ]);
            foreach($request->samples as $sample) { 
                 Content::create([
                    'test_id' => $test-> id , 
                    'nitrogen' => $sample['nitrogen'] ,
                    'phosporus' => $sample['phosphorus'] ,
                    'potassium' => $sample['potassium'] ,
                    'moist_level' => $sample['moisture'] ,
                ]);
            }
        }
        else { 
            Content::create([
                'test_id' => $request->test_id , 
                'nitrogen' => $request->samples[0]['nitrogen'] ,
                'phosporus' => $request->samples[0]['phosphorus'] ,
                'potassium' => $request->samples[0]['potassium'] ,
                'moist_level' => $request->samples[0]['moisture'] ,
            ]);
            
        }

 

        $nutrient_assessment = $test_service->perform_nutrient_assessment($request->samples , $request->title );

        if (!$request->test_id) { 
            return Inertia::render("Results" , [
                'results' => $nutrient_assessment,
            ]);
        }
        else { 
            $contents = Test::find($request->test_id)->contents;

            $n=[]; $p=[]; $k=[]; $ml=[]; $dates=[] ;  

            foreach($contents as $content) { 
                array_push($n , $content->nitrogen); 
                array_push($p , $content->phosporus); 
                array_push($k , $content->potassium); 
                array_push($ml , $content->moist_level); 
                array_push($dates, date_format($content->created_at,"m/d/y g:i A"));
            } 
    

            return Inertia::render("Results" , [
                'results' => $nutrient_assessment,
                'n' => $n,
                'p' => $p,
                'k' => $k,
                'dates' => $dates,
                'ml' => $ml,
            ]);
        }
    
    }

    public function test() { 
        return Inertia::render('Results');
    }

    public function getAllTests() { 
            
        $tests = Test::all(); 
    
        return Inertia::render('Tests' ,['tests' => $tests]); 
        
    }

    public function show($id) { 
        $test = Test::find($id); 

        $contents =  $test->contents ; 
        $n=[]; $p=[]; $k=[]; $ml=[]; $dates=[] ;  

        foreach($contents as $content) { 
            array_push($n , $content->nitrogen); 
            array_push($p , $content->phosporus); 
            array_push($k , $content->potassium); 
            array_push($ml , $content->moist_level); 
            array_push($dates, date_format($content->created_at,"m/d/y g:i A"));
        } 


        return Inertia::render('ViewTest' , [
            'n' => $n ,
            'p' => $p,
            'k' => $k ,
            'ml' => $ml ,
            'dates' => $dates 
        ]);
    }

    public function getNpkContents($contents) { 
        $n=[]; $p=[]; $k=[]; $ml=[]; $dates=[] ;  

        foreach($contents as $content) { 
            array_push($n , $content->nitrogen); 
            array_push($p , $content->phosporus); 
            array_push($k , $content->potassium); 
            array_push($ml , $content->moist_level); 
            array_push($dates, date_format($content->created_at,"m/d/y g:i A"));
        } 
    }
}
