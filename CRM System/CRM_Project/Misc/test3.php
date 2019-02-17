<?php require('../header.php');

    //SQL that sorts dates by most recent to oldest
    $sql = "select * from customer_jobs where customer_id=1 ORDER BY DATE DESC";

    $result = mysqli_query($con, $sql);
    $ary = [];
    //push the contents of the $result array into an array
    while($row=mysqli_fetch_array($result)){
        array_push($ary, $row['date']);
    };
    //can only proceed if more than 1 date in the array
    if(count($ary) > 1){
              //crate new array
           $btnDatesAry = [];
           //loop through the dates in the $ary, subtract each date from the one before it
           //store the results in a new array
            for($i=0; $i <sizeof($ary) - 1; $i++){
                //echo $ary[$i]."<br>";
                $days = date_diff(date_create($ary[$i]),date_create($ary[$i + 1]));
                $daysDiff = $days->format("%a");
                array_push($btnDatesAry, $daysDiff);
            };
         
              //print_r($btnDatesAry);
              //Add all the elements of this array & divide by their number to get average days between jobs
              foreach($btnDatesAry as $number){
                        $ttlNum += $number;
              };
                    $avgDaysbtnJobs = $ttlNum / count($btnDatesAry);
                    echo $avgDaysbtnJobs;   
    }else{
        echo 0;
    }
    
  

?>