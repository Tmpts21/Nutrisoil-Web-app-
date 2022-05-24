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

    public function save(Request $request , TestService $test_service) {

        //save to db 
        $test = Test::create([
            'user_id' => Auth::user()->id,
            'name' => $request->title 
        ]);

        foreach($request->samples as $sample) { 
            $sample = Content::create([
                'test_id' => $test-> id , 
                'nitrogen' => $sample['nitrogen'] ,
                'phosporus' => $sample['phosphorus'] ,
                'potassium' => $sample['potassium'] ,
                'moist_level' => $sample['moisture'] ,
            ]);
        }

        $nutrient_assessment = $test_service->perform_nutrient_assessment($request->samples , $request->title );

        return Inertia::render("Results" , [
            'results' => $nutrient_assessment
        ]);
    }

    public function test() { 
        return Inertia::render('Results');
    }
}
