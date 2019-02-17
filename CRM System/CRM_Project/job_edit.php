<?php require('header.php');
  
  //test if session username exists, otherwise redirect back to login
  sessionExists();

 //Call function to get URL ID 
   $job_id = getURLID();
   
 //SQL to get customer details based on ID to display in form below
 $sql = "SELECT * FROM customer_jobs where job_id='". $job_id ."'";

 //Execute the SQL
 $result = mysqli_query($con, $sql);
 //Run query with different variable name to get the name of customer
 $resultName = mysqli_query($con, $sql);
 
 //call function to display customer name
 $custName = displayName($customerid);
 

    if (isset($_POST['submit'])){
        //must ba a value for name
        if (!empty($_POST['date'])){
            $date = mysqli_real_escape_string($con, $_POST['date']);
            $knives = mysqli_real_escape_string($con, $_POST['knives']);
            $payment = mysqli_real_escape_string($con, $_POST['payment']);
            $notes = mysqli_real_escape_string($con, $_POST['notes']);
            //SQL to update customer table with new values
           $sqlUpdate = "UPDATE job SET date='" .$date. "',
             knives='" .$knives. "',
             payment='" .$payment. "',
             notes='" .$notes. "'
             where job_id='". $job_id ."'";
            $resultUpdate = mysqli_query($con, $sqlUpdate);
            if (mysqli_affected_rows($con) == 0){
                echo "Database Error, record not updated";
            }else{
                $msg = "Record updated successfully";
            }
        }else{
            $msg = "Enter a value for date.";
        }
    }

?>
   
    <article class="article-section">

          <h2><?php echo $custName; ?></h2>
          <p class="back"><a href="<?php echo previousURL(); ?>">Back</a></p>
        <div class="box-container">

            <div class="box">
                <h4>Edit Job</h4>
                <div><?php echo $msg; ?></div>
               <form action="" method="post">
                   <div class="form-group">
                      <label>Date of Job*</label>
                      <?php $row=mysqli_fetch_array($result); ?>
                      <input class="form-control" type="date" name="date" value"<?php showNewVal(fmtDateStd($date), fmtDateStd($row['date'])); ?>" placeholder="Date of Job"><br>
                      
                      <input class="form-control" type="number" name="knives" id="knives" value="<?php showNewVal($knives, $row['knives']); //function checks for new valus & displays instead?>" placeholder="Number of Knives"><br>
                      
                      <!--step attribute allows for float & integer-->
                      <input class="form-control" type="number" step="any" name="payment" id="payment" value="<?php showNewVal($payment, $row['payment']); ?>"placeholder="Payment"><br>
                      
                      <textarea class="form-control" rows="4" cols="50" name="notes" placeholder="Notes"><?php showNewVal($notes, $row['notes']); ?></textarea><br>
                         
                      <input class="btn btn-primary pull-left" type="submit" name="submit" value="Update" />
                    </div>
             </form>
            </div>
         
        </div>

      </article>

    </main>
</div>
</body>

</html>
