<?php require('header.php');

   
    //test if session username exists, otherwise redirect back to login
    sessionExists();
   
   //prevent access to admin pages by redirecting back to customer_search
   checkAdmin(); 
    //get current URL & save into SESSION variable
    //Can then use it in next pages to create a back hyperlink
    sendURL();
    
    previousURL2();
   //Call function to get URL ID 
   $customerid = getURLID();
   //get information from the customer_jobs view table
   $sqlCustJobs = "SELECT * FROM customer_jobs WHERE customer_id='".$customerid."' ORDER BY DATE DESC";
   //Get contact details for the customer - wont join to the view for some reason
   $sqlContacts = "SELECT contact_id, fname, lname, email, phone FROM contact WHERE customer_id='".$customerid."'";
   //get the totals for knives & payments
   $sqlTotals = "SELECT name, SUM(knives), SUM(payment) FROM customer_jobs WHERE customer_id='".$customerid."'";
   //get customer details
   $sqlCustomer = "SELECT * FROM customer WHERE customer_id='".$customerid."'";
   
   
   $resultTotals = mysqli_query($con, $sqlTotals) or die("Database connection issue. Please wait & retry".mysqli_connect_error());
   $resultJob = mysqli_query($con, $sqlCustJobs);
   $resultContacts = mysqli_query($con, $sqlContacts);
   $resultCustomer = mysqli_query($con, $sqlCustomer);
   
   
   
   
   //get the values from the result array
   while($row=mysqli_fetch_array($resultTotals)){
       $ttlKnives = $row['SUM(knives)'];
       $ttlPaymant = $row['SUM(payment)'];
       $custName = $row['name'];
   }

?>

      <article class="article-section">
                <?php while($row=mysqli_fetch_array($resultCustomer)){
                  $address1 = htmlspecialchars($row['address1']); 
                  $address2 = htmlspecialchars($row['address2']); 
                  $address3 = htmlspecialchars($row['address3']);
                  $county = htmlspecialchars($row['county']); 
                }
                    
                 ?>   
          <h2><a href="customer_edit.php?id=<?php echo $customerid; ?>"><?php echo ucwords(displayName($customerid) .". ". $address1 .", ". $address2 .", ". $address3 .", ". $county."."); ?></a></h2>
          <p class="back"><a href="<?php echo previousURL2(); ?>">Back</a></p>
        <div class="box-container">
        <div class="box">
            <h4>Overview</h4>
            <table class="table">
                <tr>
                   <td><b>Total Knives</b></td><td><?php echo empty($ttlKnives)? '0': $ttlKnives;  ?></td>
                </tr>
                <tr>
                    <td><b>Total Takings</b></td><td><?php echo empty($ttlPaymant)? '0': $ttlPaymant; ?></td>
                </tr>
                 <tr>
                    <td><b>Total Jobs</b></td><td><?php echo ttlJobs($customerid); ?></td>
                </tr>
                 <tr>
                    <td><b>Avg Days Between Jobs</b></td><td><?php echo getAvgDaysBtnJobs($customerid); ?></td>
                </tr>
                 <tr>
                    <td><b>Days Since Last Job</b></td><td><?php //calls 2 functions. First to get the most recent job date.
                                                                 //Then to take that date from the current date
                                                                 //Returns 'days' after the number so using intval to remove
                                                                echo intval(subtractFromTodaysDate(getNewestJobByCust($customerid))); ?></td>
                </tr>
                
            </table>
         </div> 
          <div class="box">
            <h4>Contacts</h4>
            <table class="table">
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                
                     <?php while($row=mysqli_fetch_array($resultContacts)):;?>
                      <tr>
                          <td><a href="contact_edit.php?id=<?php echo $customerid; ?>"> <?php echo ucwords($row['fname']) . " " .ucwords($row['lname']) ;?></a></td>
                          <td> <?php echo empty($row['email'])? 'None':$row['email'] ;?></td>
                          
                          <td> <?php echo $row['phone'];?></td>
                      </tr>
                  <?php endwhile; ?>
            </table>
            <p><?php echo displayLinks($customerid, $resultContacts, 'contact_add', 'contact'); ?></p>
         </div> 
            <div class="box">
              <h4>Jobs History</h4>
              
              <table class="table">
                  <th>Date</th>
                  <th>Knives</th>
                  <th>Payment</th>
                  <?php while($row=mysqli_fetch_array($resultJob)):;?>
                      
                      <tr>
                          
                          <td><a href="job_edit.php?id=<?php echo $row['job_id']; ?>"> <?php echo fmtDate($row['date']);?></a></td>
                          <td> <?php echo $row['knives'];?></td>
                          <td> <?php echo $row['payment'];?></td>
                          
                      </tr>
                  <?php endwhile; ?>
              </table>
              <p><?php echo displayLinks($customerid, $resultJob, 'job_add', 'job'); ?></p>
            </div>
        </div>

      </article>

    </main>
</div>
</body>

</html>
