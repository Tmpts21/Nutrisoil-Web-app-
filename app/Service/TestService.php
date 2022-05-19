<?php

namespace App\Service ; 

class TestService { 
    
    public function perform_nutrient_assessment($samples) : array {  

        $proccessed_samples = array() ;

        foreach($samples as $sample) { 
            $count = 1 ; 

            $nitrogen = $sample['nitrogen']; 
            $potassium = $sample['potassium']; 
            $phosporus = $sample['phosporus']; 
            
            $nutrient_assesment = array() ;

            //check nitrogen value 
            if ($nitrogen <= 10 ) { $nutrient_assesment["nitrogen"] = "LOW"; } 
            else if ($nitrogen > 10 and  $nitrogen <= 20 ) { $nutrient_assesment["nitrogen"] = "MEDIUM"; }
            else if ($nitrogen > 20 and $nitrogen <= 30 ) {  $nutrient_assesment["nitrogen"] = "HIGH"; }
            else if ($nitrogen > 30 ) {  $nutrient_assesment["nitrogen"] = "EXCESSIVE"; }

            //check potassium value 
            if ($potassium <= 75 ) { $nutrient_assesment["potassium"] = "VERY LOW"; } 
            else if ($potassium > 75 and  $potassium <= 150 ) { $nutrient_assesment["potassium"] = "LOW"; }
            else if ($potassium > 150 and $potassium <= 250 ) {  $nutrient_assesment["potassium"] = "MEDIUM"; }
            else if ($potassium > 250 and $potassium <= 800 ) {  $nutrient_assesment["potassium"] = "HIGH"; }
            else if ($potassium > 800 ) {  $nutrient_assesment["potassium"] = "EXCESSIVE"; }

            //check phosporus value 
            if ($phosporus <= 20 ) { $nutrient_assesment["phosporus"] = "LOW"; } 
            else if ($phosporus > 20 and  $phosporus <= 40 ) { $nutrient_assesment["phosporus"] = "MEDIUM"; }
            else if ($phosporus > 40 and $phosporus <= 100 ) {  $nutrient_assesment["phosporus"] = "HIGH"; }
            else if ($phosporus > 100 ) {  $nutrient_assesment["phosporus"] = "EXCESSIVE"; }

            //push the nutrient assesment 
            array_push($proccessed_samples , $nutrient_assesment);
            
        }
        return $proccessed_samples; 

    }

}