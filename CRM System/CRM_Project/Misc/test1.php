<?php
function fmtDate($date){
    
    $dateObj = date_create($date);
    $fd = date_format($dateObj,"d-m-Y");
    return $fd;
}
$test = "test";

echo empty($test) ? 'empty' : $test;

echo "<br>";
//subtract 2 dates

    function subtractDates($firstDate, $secondDate){
        $date1=date_create($firstDate);
        $date2=date_create($secondDate);
        $diff=date_diff($date1,$date2);
        echo $diff->format("%R%a days");   
    }
    
    $fdate = "";
    
    
 /*   
    function subtractFromTodaysDate($firstDate){
        $today = date("Y/m/d");
        $date1=date_create($firstDate);
        $date2=date_create($today);
        //Just return 0 if date is > than todays
        //Anything else just messes with the days calculation
        if ($date1 > $date2){
            return 0;
        }else{
            $diff=date_diff($date1,$date2);
            return $diff->format("%R%a days");
        }
        
    }
    */
    $j = "14-06-2018";
    $x = date_create($j);
    echo date_format($x, 'd/m/Y'); //14/04/2018
    
    
    echo "<br>";
    //echo $today = date("Y/m/d");
?>
