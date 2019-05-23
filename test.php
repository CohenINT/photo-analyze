<?php

require("src/log.php");
error_reporting(E_ALL);
//error_reporting(E_ALL & ~E_WARNING & ~E_NOTICE);
ini_set('max_execution_time',30);




$test_dict["4_1_0"]->counter=1;
$test_dict["6_0_0"]->counter=2;
$test_dict["4_4_4"]->counter=9;
$test_dict["13_13_1"]->counter=5;
$test_dict["13_13_15"]->counter=3;
$test_dict["14_5_0"]->counter=3;
$test_dict["15_13_1"]->counter=4;
$test_dict["15_16_2"]->counter=11;
$test_dict["16_7_0"]->counter=22;
$test_dict["16_12_0"]->counter=55;
$test_dict["16_14_2"]->counter=51;
$test_dict["16_16_4"]->counter=13;
$test_dict["17_8_0"]->counter=12;
$test_dict["17_15_2"]->counter=17;
$test_dict["21_13_0"]->counter=20;
$test_dict["22_20_7"]->counter=21;
$test_dict["22_18_6"]->counter=23;
$test_dict["22_20_7"]->counter=71;
$test_dict["28_25_8"]->counter=41;
$test_dict["28_29_15"]->counter=42;
$test_dict["29_19_7"]->counter=36;
$test_dict["29_22_6"]->counter=85;
$test_dict["29_23_11"]->counter=19;



// function find_max(&$arr1,$priorityNum)
// {
//  $exlude=array();
//  $max=0;

// $logger=new Log();


//   while($priorityNum>0)
//   {

  
//   foreach ($arr1 as $cell) 
//   {//finding the max value in the array
//       if($cell->counter > $max)
//       {
//           $max = $cell->counter;
//           $logger->WriteLog("new max value = ");
//           $logger->WriteLog($max);


//       }
//   }//end of for each loop


//     if(!in_array($max,$exlude))//check if this max value is in list already
//     {
//         if($priorityNum>0)
//         {
//             $logger->WriteLog("priorityNum  = $priorityNum");
//             array_push($exlude,$max);
//             $priorityNum=$priorityNum-1;//5 times for finding top 5 max values
//         }
        
//     }
     
     
//   }//end of while loop


 

// unset($arr1);
// //$logger->WriteLog("finished loop:   current max = $max ,   exlude list = [".$exlude[0].", ".$exlude[1]." , ".$exlude[2]." ,".$exlude[3]." ,".$exlude[4]."]");

// return $exlude;
// }//end of function find_max()


//$script_start=microtime(true);



//$logger->WriteLog("script runtime in seconds: ".((microtime(true)-$script_start )));



// $max = @$argv[1] ? $argv[1] : 100;
// $sample = @$argv[2] ? $argv[2] : 5;
// printf("Start(%d) ...", $max);
// $it = 0;
// do {
//     $s = microtime(true);
//     /* begin test */
//     $ts = [];
//     while (count($ts)<$max) {
//         $t = new Thread();
//         $t->start();
//         $ts[]=$t;
//     }
//     $ts = [];
//     /* end test */
    
//     $ti [] = $max/(microtime(true)-$s);
//     printf(".");
// } while ($it++ < $sample);
// printf(" %.3f tps\n", array_sum($ti) / count($ti));







$fruits = array("1"=>"4_1_0", "5"=>"13_13_1", "3"=>"13_13_15", "9"=>"4_4_4" );
krsort($fruits,SORT_NUMERIC);
$index=0;
foreach ($fruits as $key => $val) {
   
    if($index<2)
    {
        echo $test_dict[$val]->counter;
      $index++;
    }
    else{
        
        die("stop");
    }

}


echo "hello\n";

