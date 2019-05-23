<?php

require("src/log.php");

$logger = new Log();
$dict_color[0]->counter=1;
$logger->WriteLog("BEFORE:  dict_colors[0]->counter = ".$dict_color[0]->counter);
$dict_color[0]->counter++;

$logger->WriteLog("AFTER:  dict_colors[0]->counter = ".$dict_color[0]->counter);

echo $dict_color[0]->counter;


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