<?php

$script_start=microtime(true);
ini_set('max_execution_time',30);
header("Content-type: application/json; charset=utf-8");
error_reporting(0);
require("log.php");


define("UPLOAD_FOLDER","uploads");
$logger= new Log();

$dict_index=array();



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
        $dict_colors[$temp]->counter=1;
       $dict_colors[$temp]->display="RGB($r,$g,$b)";

       

    }

     else{
     //if already exist ,count.
        $dict_colors[$temp]->counter++;

     }

     
        
      }//end of for each loop

     

      //creating the dict_index in this format : dict_index["33"]->"111_220_255"  or =  still need to check

     



         //TEST
         


         //CREAT DICT_INDEX
       //from the value i can access the display and counter propertys
       //and from the key i can access the index of the dict_colors array
         foreach ($dict_colors as $key => $value) {
          
           $dict_index["$value->counter"]=$key;//"111_22_111"
            
        }

        krsort($dict_index,SORT_NUMERIC);//sorting according to counter value which is the index here DESC order
        $amount_prior=0;

       foreach ($dict_index as $key => $val) {//taking nth highest numbers (which the highest starts from 0 index)
       $logger->WriteLog("$amount_prior is the amount_prior" );
          if($amount_prior<2)//access only the largest two
            {
            $logger->WriteLog("yes");
          $logger->WriteLog( $dict_colors[$val]->display);
         $amount_prior++;
           }
         else{
            $logger->WriteLog("script runtime in seconds: ".((microtime(true)-$script_start )));

        die();//no need to loop more after we found the highest numbers.
          }

}
         


       







    }
}


$logger->WriteLog("script runtime in seconds: ".((microtime(true)-$script_start )));

//TODO: find the most effiecnt way to look in the json object for the 5 most seen RGB , option 1 : sort and dvidie by half algoritm, option 2: sort in desecing order and pick the 5 first item from the json or find other solution.

