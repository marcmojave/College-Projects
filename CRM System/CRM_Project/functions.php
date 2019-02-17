<?php
   //Takes in a date & subtracts it from today & returns the days
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
            return $diff->format("%a");
        }
 };
        
   
 //Return a new DateTime object, and then format the date
 function fmtDate($date){

    $dateObj = date_create($date);
    $fd = date_format($dateObj, "d-m-Y");
    return $fd;
};
    //formats a date to be dd/mm/yyyy
    function fmtDateStd($date){
         $x = date_create($date);
         $stdDate = date_format($x, 'd/m/Y');    
         return $stdDate;
    };
     

//customers with longest time since last job
  function oldJobs(){
    global $con;
    $sql = "SELECT customer_id, name, knives, county, max(date) as date FROM customer_jobs "; 
    $sql .= "GROUP BY name ORDER BY DATE ASC LIMIT 5";
    $result = mysqli_query($con, $sql);
    return $result;
  };
  
  //customers with longest time since last job
  function allJobsOrderedOld(){
    global $con;
    $sql = "SELECT customer_id, name, knives, county, max(date) as date FROM customer_jobs "; 
    $sql .= "GROUP BY name ORDER BY DATE ASC";
    $result = mysqli_query($con, $sql);
    return $result;
  };
  
  
    //Get the most recent job date
  function getNewestJobByCust($customer_id){
    global $con;
    $sql = "SELECT max(date) as date FROM customer_jobs "; 
    $sql .= "WHERE customer_id='".$customer_id."'";
    $result = mysqli_query($con, $sql);
    $row=mysqli_fetch_assoc($result);
    return $row['date'];
  };
  
//get total number of customers
function ttlCustomers(){
    global $con;
    $sql = "SELECT COUNT(*) as ttlCustomer FROM customer";
    $result = mysqli_query($con, $sql);
    while($row=mysqli_fetch_array($result)){
       return $row['ttlCustomer']; 
    };
    
};
    //Total Number of knives
   function ttlKnives(){
        global $con;
        $sql = "SELECT SUM(knives) as ttlKnives FROM job";
        $result = mysqli_query($con, $sql);
        while($row=mysqli_fetch_array($result)){
           return $row['ttlKnives']; 
        };
   };
       
       //Total Number of Jobs
   function ttlJobsOverall(){
        global $con;
        $sql = "SELECT COUNT(job_id) as ttlJobs FROM job";
        $result = mysqli_query($con, $sql);
        while($row=mysqli_fetch_array($result)){
           return $row['ttlJobs']; 
        };
   };
       
      //Total Number of Jobs per customer
   function ttlJobs($customerid){
        global $con;
        $sql = "select count(*) as ttlJobs from customer_jobs where customer_id='". $customerid ."'";
        $result = mysqli_query($con, $sql);
        while($row=mysqli_fetch_array($result)){
           return $row['ttlJobs']; 
        };
   };
       
    //Top 5 customers by knives sharpened
    function top5Customers(){
         global $con;
        $sql = "SELECT customer_id, name, sum(knives) as knives, county FROM customer_jobs "; 
        $sql .="GROUP BY name order by knives DESC LIMIT 5";
        $result = mysqli_query($con, $sql);
       
        return $result;
    };
    
    //Display updated value after edit
    function showNewVal($newVal, $oldVal){
        echo empty($newVal)? $oldVal:$newVal;
    };
    
    //get the last customer ID from customer table
    function lastCustID(){
        global $con;
        $sql = "SELECT customer_id FROM customer";
        $result = mysqli_query($con, $sql);
        while($row=mysqli_fetch_array($result)){
            $custId = $row['customer_id'];
        }
        return $custId;
    };
    
    
    //get ID from URL, if no ID redirect back to the manage customer page
    function getURLID(){
       if (isset($_GET['id']) && !empty($_GET['id']) && is_numeric($_GET['id']) && $_GET['id'] <= lastCustID()){
          return $customerid = $_GET['id'];  
       }else{
           if ((stripos($_SERVER['REQUEST_URI'], 'jobs') != 0)){
               header('location: customers.php');
           }else{
               header('location: customer_manage.php');
           }
                
       }
    };
    
    //Displays the name of a customer based on the customer ID provided
    function displayName($customerid){
        global $con;
        //SQL to get customer details based on ID to display in form below
         $sql = "SELECT * FROM customer where customer_id='". $customerid ."'";
         
         $resultName = mysqli_query($con, $sql);
         //Get the name of the customer to display at top of page
          while($row=mysqli_fetch_array($resultName)){
                $custName = htmlspecialchars($row['name']);
          }
          //Fist letter of each word uppercased
          return ucwords($custName);
    };
    
    //function to shorten real escap string
    function res($con, $frmValue){
        mysqli_real_escape_string($con, $frmValue);
    };
    //HTML special characters
    function hsc($string="") {
         return htmlspecialchars($string);
    };
    
    //Sanitize input float number
    function sanitizeFloat($var){
        filter_var($var, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
    };
    
    //Return list of counties for drop down
     function counties(){
         return $allCounties = array('Antrim', 'Armagh', 'Carlow', 'Cavan', 'Clare', 'Cork', 'Derry', 'Donegal',
    'Down', 'Dublin', 'Fermanagh', 'Galway', 'Kerry', 'Kildare', 'Kilkenny', 'Laois', 'Leitrim',
    'Limerick', 'Longford', 'Louth', 'Mayo', 'Meath', 'Monaghan',
    'Offaly', 'Roscommon', 'Sligo', 'Tipperary', 'Tyrone', 'Waterford', 'Westmeath', 'Wexford', 'Wicklow');
        
     };
     
     //will grap the current URL and save into SESSION variable
    function sendURL(){
        session_start();
        $_SESSION['url'] = $_SERVER['REQUEST_URI'];
    };
    //Recieves the URL from previous page & parses it
    function previousURL(){
        session_start();
        $url = $_SESSION['url'];
        $path = (explode('/', $url));
        return $path[2];  
    };
    
      //Recieves the URL from previous page & parses it
    function previousURL2(){
        session_start();
        $url = $_SESSION['url2'];
        $path = (explode('/', $url));
        return $path[2];  
    };
    
    
     //will grap the current URL and save into SESSION variable
    function sendURL2(){
        session_start();
        $_SESSION['url2'] = $_SERVER['REQUEST_URI'];
    };
    
    //test if session username exists, otherwise redirect back to login
    function sessionExists(){
        if (empty($_SESSION['un']) || !isset($_SESSION['un'])){
              header("location:login.php");
        } 
    };
    
    //prevent access to admin pages by redirecting back to customer_search
    function checkAdmin(){
        if (isset($_SESSION['admin']) && $_SESSION['admin'] != 'a'){
            header("location:customer_search.php");
        }
    };
     
    
    //Display different message if data exists or not
    //used for contacts & jobs in jobs page
     function displayLinks($customerid, $result, $page, $text){
        
             if(mysqli_num_rows($result) == 0){
                        //NLBR2 function makes line brakes visable in browser
                        $msg = nl2br("No ".$text.='s'." \n <a href='$page.php?id=$customerid'>Set one up here</a>");
               }else{
                        $msg = "<a href='$page.php?id=$customerid'>Add another $text</a>";
               }
               return $msg;
     };
     
     //function to validate an email
     function has_valid_email_format($value) {
        $email_regex = '/\A[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,}\Z/i';
        return preg_match($email_regex, $value) === 1;
     };
     
     
     
     
     function getAvgDaysBtnJobs($customer_id){
         global $con;
          //SQL that sorts dates by most recent to oldest
            $sql = "select * from customer_jobs where customer_id= '".$customer_id."' ORDER BY DATE DESC";
        
            $result = mysqli_query($con, $sql);
            $ary = [];
            //push the contents of the $result array into an array
            while($row=mysqli_fetch_array($result)){
                array_push($ary, $row['date']);
            };
            //can only proceed if more than 1 date in the array
            if(count($ary) > 1){
                      //create new array
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
                            //divide the total value by the amt of number to get avg
                            $avgDaysbtnJobs = $ttlNum / count($btnDatesAry);
                            return round($avgDaysbtnJobs, 0);   
            }else{
                return 'N/A';
            }
     }
  

?>
