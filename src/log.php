<?php


class Log{


    public function WriteLog($msg)
    {
      $current_datetime=date("d.m.y H:i:s");
      $file="./logs/log.txt";
      file_put_contents($file,$msg."   |".$current_datetime."  \n",FILE_APPEND| LOCK_EX);
    
      


    }


}