<?php

define("LOG_FOLDER","logs");
define("LOG_FILE","log.txt");

class Log{


    public function WriteLog($msg)
    {
      $current_datetime=date("d.m.y H:i:s");
      $file="./".LOG_FOLDER."/".LOG_FILE;
      if(!file_exists($file))
      {
         if(!file_exists("./".LOG_FOLDER))
         {
           mkdir("./".LOG_FOLDER);
         }

         fopen("./".LOG_FOLDER."/".LOG_FILE, 'w') or die();
      
      }
     
      file_put_contents($file,$msg."   |".$current_datetime."  \n",FILE_APPEND| LOCK_EX);
    
      


    }


}