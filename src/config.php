
<?php

ini_set('max_execution_time',30);
header("Content-type: application/json; charset=utf-8");
error_reporting(0);
require("log.php");


define("NTH_TOP_RGB",5);//define to show 5 top RGB values from picture
define("UPLOAD_FOLDER","uploads");
$logger= new Log();
$dict_colors=array();
$dict_index=array();
$dict_result=array();
$colors=array();
$total_counter_sum=0;
$amount_prior_index=0;


//test_dict
//array for testing

$test_dict["4_1_0"]->counter=1;
$test_dict["4_1_0"]->display="RGB(4,1,0)";

$test_dict["6_0_0"]->counter=2;
$test_dict["6_0_0"]->display="RGB(6,0,0)";

$test_dict["4_4_4"]->counter=9;
$test_dict["4_4_4"]->display="RGB(4,4,4)";

$test_dict["13_13_1"]->counter=5;
$test_dict["13_13_1"]->display="RGB(13,13,1)";

$test_dict["13_13_15"]->counter=3;
$test_dict["14_5_4"]->display="RGB(14,5,4)";


$test_dict["14_5_0"]->counter=3;
$test_dict["14_5_0"]->display="RGB(14,5,0)";

$test_dict["15_13_1"]->counter=4;
$test_dict["15_13_1"]->display="RGB(15,13,1)";

$test_dict["15_16_2"]->counter=11;
$test_dict["15_16_2"]->display="RGB(15,16,2)";



$test_dict["16_7_0"]->counter=22;
$test_dict["16_7_0"]->display="RGB(16,7,0)";


$test_dict["16_12_0"]->counter=55;
$test_dict["16_12_0"]->display="RGB(16,12,0)";


$test_dict["16_14_2"]->counter=51;
$test_dict["16_14_2"]->display="RGB(16,14,2)";



$test_dict["16_16_4"]->counter=13;
$test_dict["16_16_4"]->display="RGB(16,16,4)";


$test_dict["17_8_0"]->counter=12;
$test_dict["17_8_0"]->display="RGB(17,8,0)";



$test_dict["17_15_2"]->counter=17;
$test_dict["17_15_2"]->display="RGB(17,15,2)";



$test_dict["21_13_0"]->counter=20;
$test_dict["21_13_0"]->display="RGB(21,13,0)";


$test_dict["22_20_7"]->counter=21;
$test_dict["22_20_7"]->display="RGB(22,0,7)";



$test_dict["22_18_6"]->counter=23;
$test_dict["22_18_6"]->display="RGB(22,18,6)";



$test_dict["22_20_71"]->counter=71;
$test_dict["22_20_71"]->display="RGB(22,20,71)";



$test_dict["28_25_8"]->counter=41;
$test_dict["28_25_8"]->display="RGB(28,25,8)";



$test_dict["28_29_15"]->counter=42;
$test_dict["28_29_15"]->display="RGB(28,29,15)";

$test_dict["29_19_7"]->counter=36;
$test_dict["29_19_7"]->display="RGB(29,19,7)";


$test_dict["29_22_6"]->counter=85;
$test_dict["29_22_6"]->display="RGB(29,22,6)";




$test_dict["29_23_11"]->counter=19;
$test_dict["29_23_11"]->display="RGB(29,23,11)";

//test_dict
