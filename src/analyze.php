<?php

$script_start=microtime(true);
ini_set('max_execution_time',100);
header("Content-type: application/json; charset=utf-8");
error_reporting(0);
require("log.php");
require("dict.php");

define("UPLOAD_FOLDER","uploads");
$logger= new Log();


 function isExist(&$dict,$rgb_value)
{
    $len=count($dict);
    //$log=new Log();
    for($index=0;$index<$len;$index++)
    {
       $is_Exist=  array_search($rgb_value,$dict);
    //    //$log->WriteLog("isExist()  -   index = $index");
       if($is_Exist!=false)
       {
        //    //$log->WriteLog("isExist()  finished with yes");
           return "yes";
       }
    }
    // //$log->WriteLog("isExist()  finished with no");
    return "no";
   
} 



if($_SERVER["REQUEST_METHOD"]=="POST")
{
   
    
    if(isset($_FILES["file_load"])&& $_FILES["file_load"]["error"]==0)
    {
     
     
    //   //$logger->WriteLog("target folder : ".UPLOAD_FOLDER);
      
      if(!file_exists(UPLOAD_FOLDER))
      {
          mkdir(UPLOAD_FOLDER,0777,true);
      }
          $target_file=UPLOAD_FOLDER."/".$_FILES["file_load"]["name"];
        //   //$logger->WriteLog("target path: ".$target_file);
          
          $allowed = array("jpg","jpeg");
          $ext= strtolower(pathinfo($target_file,PATHINFO_EXTENSION));


          
          if(!in_array($ext,$allowed))
          {
            //   //$logger->WriteLog("FILE_EXT_NOT_ALLOWED");
              exit("FILE_EXT_NOT_ALLOWED");
          }

          

        
 
          move_uploaded_file($_FILES["file_load"]["tmp_name"],$target_file);
          
          //making array of RGB index:

          $image = imagecreatefromjpeg($target_file); 
         // sleep(10);
          if(!$image)
          {
             die("ERROR_IMAGE_LOADING");
          }
        
          $width = imagesx($image);
          
          $height = imagesy($image);
          

          $colors=array();
        
        
          

          for ($y = 0; $y < $height; $y++) {
      
          for ($x = 0; $x < $width; $x++) {
              $rgb = imagecolorat($image, $x, $y);
            
 
          //TODO: I HAVE TO USE THE CALCULATED R G AND B AND NOT THE INDEX IN RGB VALUE.
            
              array_push($colors,$rgb);
              
          }  
        
      }//end of outter for loop
     
      
   
   $dict_colors=array();

   foreach ($colors as $value) {
    $r = ($value >> 16) & 0xFF;
    $g = ($value >> 8) & 0xFF;
    $b = $value & 0xFF;
    $temp=$r."_".$g."_".$b;
           // //$logger->WriteLog("isset(dict_colors['$temp'])  = ".$dict_colors["$r_$g_$b"]);
    
     if(!isset($dict_colors[$temp]->display))
     {//if not exist, creating.
        //$logger->WriteLog("CREATING array ");
      
       $dict_colors[$temp]->display="RGB($r,$g,$b)";
       $dict_colors[$temp]->counter=1;
       //$logger->WriteLog("WHILE IN CREATEING dict_color[$temp]->counter = ". $dict_colors[$temp]->counter);
     }

     else{
     //if already exist ,count.
     //$logger->WriteLog("ISSET = TRUE:: dict_color->counter = (".$dict_colors[$temp]->counter.") is this 1?");
       //$logger->WriteLog("BEFORE COUNTING COUNTER IS  = ".$dict_colors[$temp]->counter."  counting 1 to exist array");
        $dict_colors[$temp]->counter++;
        //$logger->WriteLog("AFTER count the counter property is: ".$dict_colors[$temp]->counter);

     }

         //TODO: count the appearences of every RGB and save it to a dictonery index variable
     
        
      }
         //TEST

        $test = json_encode($dict_colors);
        echo($test);










    }
}


$logger->WriteLog("script runtime in seconds: ".((microtime(true)-$script_start )));
//TODO:  the colors array saving the $rgb values as planned , but the problem is with the dict_colors. iam having hard time to define it correctly.
//up until now it created duplicated indexes and it messes up with the counting, 
//i need to make a unique index for every $rgb, and make a counter for it.
