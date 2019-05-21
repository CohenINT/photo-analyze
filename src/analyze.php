<?php

$script_start=microtime(true);


error_reporting(E_ALL);
require("log.php");
define("UPLOAD_FOLDER","uploads");
$logger= new Log();


if($_SERVER["REQUEST_METHOD"]=="POST")
{
   
    
    if(isset($_FILES["file_load"])&& $_FILES["file_load"]["error"]==0)
    {
     
     
      $logger->WriteLog("target folder : ".UPLOAD_FOLDER);
      
      if(!file_exists(UPLOAD_FOLDER))
      {
          mkdir(UPLOAD_FOLDER,0777,true);
      }
          $target_file=UPLOAD_FOLDER."/".$_FILES["file_load"]["name"];
          $logger->WriteLog("target path: ".$target_file);
          
          $allowed = array("jpg","jpeg");
          $ext= strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

         $logger->WriteLog("ext : ".$ext);

          
          if(!in_array($ext,$allowed))
          {
              exit("FILE_EXT_NOT_ALLOWED");
          }

          

        
 
          $file_path=$target_file.".".$ext;
          move_uploaded_file($_FILES["file_load"]["tmp_name"],$file_path);

          //making array of RGB:

          $image = imagecreatefromjpeg($file_path); 
          
        
          $width = imagesx($image);
          $height = imagesy($image);
          $colors=array();
          $dict_colors=null;
        
          for ($y = 0; $y < $height; $y++) {
      
          for ($x = 0; $x < $width; $x++) {
              $rgb = imagecolorat($image, $x, $y);
              $r = ($rgb >> 16) & 0xFF;
              $g = ($rgb >> 8) & 0xFF;
              $b = $rgb & 0xFF;
              $dict_colors[$r."_".$g."_".$b]->display="RGB($r,$g,$b)";
              $dict_colors[$r."_".$g."_".$b]->counter=0;
              array_push($colors,$rgb);
              
          }  
        
      }//end of outter for loop





         //count the appearences of every RGB and save it to a dictonery variable
        foreach ($colors as $rgb) {

              $r = ($rgb >> 16) & 0xFF;
              $g = ($rgb >> 8) & 0xFF;
              $b = $rgb & 0xFF;
              
           
          
              $dict_colors[$r."_".$g."_".$b]->counter++;

           
        }



          //test

    //       foreach ($colors as $rgb) {

    //         $r = ($rgb >> 16) & 0xFF;
    //         $g = ($rgb >> 8) & 0xFF;
    //         $b = $rgb & 0xFF;
          
        
    //        $test= $dict_colors[$r."_".$g."_".$b]->display." ," . " counter: " .$dict_colors[$r."_".$g."_".$b]->counter;
    //        $logger->WriteLog($test;


         
    //   }










    }
}


$logger->WriteLog("script runtime in seconds: ".((microtime(true)-$script_start )*1000));