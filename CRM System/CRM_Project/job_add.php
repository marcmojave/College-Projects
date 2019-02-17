<?php require('header.php');
   
    //test if session username exists, otherwise redirect back to login
    sessionExists();
   
    //Call function to get URL ID 
    $customerid = getURLID();
    
    //call function to display customer name
    $custName = displayName($customerid);
    
    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        
        if (empty($_POST['date'])){
           $msg = "Date is a required field"; 
        }else{//assign POST values to variables - res = function defined in functions.php
            $date = $_POST['date'];
            //Removes illegal characters from integer - also use typecasting
            $knives = (int) filter_var($_POST['knives'], FILTER_SANITIZE_NUMBER_INT);
            //removes all illegal characters from  Payment, allow decimal point
            $payment = (float) filter_var($_POST['payment'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
            
            $notes = mysqli_real_escape_string($con, $_POST['notes']);
            
            $sqlInsert = "INSERT INTO job(date, knives, payment, notes)";
            $sqlInsert .= "VALUES('".$date."', '".$knives."', '".$payment."', '".$notes."')";
            
            $result = mysqli_query($con ,$sqlInsert);
            
            if(mysqli_affected_rows($con) > 0){
                $msg =  "Job has been added";
                //Get the ID of teh inserted record
                $last_id = mysqli_insert_id($con);
                //insert cust id & job id into job_for_customer table
                $sqlInsertJunction = "INSERT INTO job_for_customer(job_id, customer_id) VALUES ('".$last_id."', '".$customerid."')";
                $resJunction = mysqli_query($con, $sqlInsertJunction);
            }
        }
        
    }

?>

      <article class="article-section">

          <h2><?php echo $custName; ?></h2>
          <p class="back"><a href="<?php echo previousURL(); ?>">Back</a></p>
        <div class="box-container">

            <div class="box">
                <h4>Add job</h4>
                <div><?php echo $msg; ?></div>
               <form action="" method="post">
                   <div class="form-group">
                      <label>Date of Job*</label>
                      <input class="form-control" type="date" name="date" placeholder="Date of Job"><br>
                      
                      <input class="form-control" type="number" name="knives" id="knives" value="" placeholder="Number of Knives"><br>
                      
                      <!--step attribute allows for float & integer-->
                      <input class="form-control" type="number" step="any" name="payment" id="payment" placeholder="Payment"><br>
                      
                      <textarea class="form-control" rows="4" cols="50" name="notes" placeholder="Notes"></textarea><br>
                         
                      <input class="btn btn-primary pull-left" type="submit" value="Add" name="submit"/>
                    </div>
             </form>
            </div>
         
        </div>

      </article>

    </main>
</div>
</body>

</html>
