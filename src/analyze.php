<?php

$script_start=microtime(true);

require("config.php");

if($_SERVER["REQUEST_METHOD"]=="POST")
{
   
    
    if(isset($_FILES["file_load"])&& $_FILES["file_load"]["error"]==0)
    {
     
     
      
      if(!file_exists(UPLOAD_FOLDER))
      {
          mkdir(UPLOAD_FOLDER,0777,true);
      }
          $target_file=UPLOAD_FOLDER."/".$_FILES["file_load"]["name"];

          
          $allowed = array("jpg","jpeg");
          $ext= strtolower(pathinfo($target_file,PATHINFO_EXTENSION));


          
          if(!in_array($ext,$allowed))
          {
            $logger->WriteLog("unsuppored file loaded. exiting...");
            exit("File extention not allowed. please try again");
          }

          

        
 
          move_uploaded_file($_FILES["file_load"]["tmp_name"],$target_file);
          
          //making array of RGB index:

          //GD Library 
          // First thing I found on Google when I was searching a way to import jpeg file into php variable, was a stackoverflow solution
          //so I took parts of it and changed it for my needs. it was perfect choice for this matter.
          $image = imagecreatefromjpeg($target_file); 

          if(!$image)
          {
              $logger->WriteLog("error in loading picture. exiting...");
             die("We are sorry, there was an error loading that picture, please try again later.");
          }
        
          $width = imagesx($image);
          
          $height = imagesy($image);
          

        

          for ($y = 0; $y < $height; $y++) {
      
          for ($x = 0; $x < $width; $x++) {
              $rgb = imagecolorat($image, $x, $y);//finding the rgb index and storing in $colors array
                          
              array_push($colors,$rgb);
              
          }  
        
      }//end of outter for loop
     
      
   

   foreach ($colors as $value) { 
    $r = ($value >> 16) & 0xFF;
    $g = ($value >> 8) & 0xFF;
    $b = $value & 0xFF;
    $temp=$r."_".$g."_".$b;

    if(!isset($dict_colors[$temp]->display))
     {//if not exist, creating item .
        $dict_colors[$temp]->counter=1;
       $dict_colors[$temp]->display="RGB($r,$g,$b)";

    }  else{
     //if already exist ,count.
        $dict_colors[$temp]->counter++;
     }
 
         }//end of foreach loop on $colors

    

      //creating the dict_index in this format : dict_index["33"]="111_220_255"  
         
       //from the value i can access the display and counter propertyes
       //and from the key i can access the index of the dict_colors array
         foreach ($dict_colors as $key => $value) {
          
           $dict_index["$value->counter"]=$key;//"111_22_111"
           $total_counter_sum+=$dict_colors[$key]->counter;//calculating the total sum of counter of any RGB color to use for the calculation of percentage any chosen RGB from picture
         
        }

        krsort($dict_index,SORT_NUMERIC);//sorting according to counter value which is the index here DESC order
        $amount_prior_index=0;

       foreach ($dict_index as $key => $val) {//taking nth highest numbers (which the highest starts from 0 index)

          if($amount_prior_index<NTH_TOP_RGB)//access only the largest nth values
            {

        $dict_colors[$val]->percent=( $dict_colors[$val]->counter/$total_counter_sum)*100;//calculation appreance of RGB in percentage
        array_push($dict_result,$dict_colors[$val]);//creating final json object which would be send back to user
              
           $amount_prior_index++;



           }
         else
         {
            //sending back to client side
               $dict_result = json_encode($dict_result);
               echo $dict_result;
               $logger->WriteLog("script runtime in seconds: ".((microtime(true)-$script_start )));

            die();//no need to loop more after we found the highest numbers.
          }

}
         

    }
}




