<?php

namespace App\Service ; 

class TestService { 
    
    public function perform_nutrient_assessment($samples , $title) : array {  

        $proccessed_samples = array() ;

        foreach($samples as $sample) { 

            $nitrogen = $sample['nitrogen']; 
            $potassium = $sample['potassium']; 
            $phosporus = $sample['phosphorus']; 
            $moist_level = $sample['moisture'];
            $nutrient_assesment = array() ;

            //check nitrogen value 
            $ni = "";
            if ($nitrogen <= 10 )  $ni = "LOW"; 
            else if ($nitrogen > 10 and  $nitrogen <= 20 )  $ni = "MEDIUM"; 
            else if ($nitrogen > 20 and $nitrogen <= 30 )   $ni = "HIGH"; 
            else if ($nitrogen > 30 )   $ni = "EXCESSIVE"; 

            //check potassium value 
            $pot = "";
            if ($potassium <= 75 ) $pot = "VERY LOW"; 
            else if ($potassium > 75 and  $potassium <= 150 )  $pot = "LOW"; 
            else if ($potassium > 150 and $potassium <= 250 )  $pot = "MEDIUM";
            else if ($potassium > 250 and $potassium <= 800 )  $pot = "HIGH";
            else if ($potassium > 800 )  $pot = "EXCESSIVE";

            //check phosporus value 
            $phos = "" ;
            if ($phosporus <= 20 ) $phos = "LOW";  
            else if ($phosporus > 20 and  $phosporus <= 40 )  $phos = "MEDIUM" ;
            else if ($phosporus > 40 and $phosporus <= 100 )  $phos= "HIGH"; 
            else if ($phosporus > 100 )   $phos = "EXCESSIVE" ; 

            $moist = "" ;
            if ( $moist_level <= 80 and $moist_level >=65  )  $moist= "HIGH";
            else if ( $moist_level >= 50 and $moist_level <=65  )  $moist= "MEDIUM";
            else if ( $moist_level < 50  )  $moist= "LOW";
            else  $moist = "VERY HIGH";

            $nutrient_assesment["nitrogen"] = [
                "assesment"  =>  $ni ,
                "value" => $sample["nitrogen"]  
            ] ;

            $nutrient_assesment["phosporus"] = [
                "assesment"  => $phos ,
                "value" => $sample["phosphorus"] 
            ] ;

            $nutrient_assesment["potassium"] = [
                "assesment"  =>  $pot ,
                "value" =>  $sample["potassium"] 
            ] ;

            $nutrient_assesment["moisture_level"] = [
                "assesment"  => $moist ,
                "value" => $sample["moisture"]
            ] ;

            $nutrient_assesment["title"] = $title ;
            

            //push the nutrient assesment 
            array_push($proccessed_samples , $nutrient_assesment);

        }

        return $proccessed_samples; 

    }

}
