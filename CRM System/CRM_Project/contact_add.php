<?php 
  //connect to header.php
  require('header.php'); 
  
  //test if session username exists, otherwise redirect back to login
  sessionExists();
  
   //Call function to get URL ID 
   $customerid = getURLID();
     
 
  

  //call function to display customer name
  $custName = displayName($customerid);
  
  //check if submit button is clicked
  if (isset($_POST['submit'])){
    if (!empty($_POST['fname']) || !empty($_POST['lname'])){
      //save post values into vatiables after using escape function
      $fname = mysqli_real_escape_string($con, $_POST['fname']);
      $lname = mysqli_real_escape_string($con, $_POST['lname']);
      $email = mysqli_real_escape_string($con, $_POST['email']);
      $phone = mysqli_real_escape_string($con, $_POST['phone']);
      $job_title = mysqli_real_escape_string($con, $_POST['job_title']);
      
      
      
      //create insert query for contact table
      $sqlInsert = "insert into contact(fname, lname, email, phone, customer_id)";
      $sqlInsert .= "values('".$fname."', '".$lname."', '".$email."', '".$phone."', '".$customerid."')";
      //execute query
      $result = mysqli_query($con, $sqlInsert);
      //Check if a row has been inserted
      if (mysqli_affected_rows($con) > 0){
        $msg = "Contact added successfully";
        
      }else{
        $msg = "Did not successfully save the record.";
      }
  
    }else{
      $msg = "You must have a vlaue for first or last name";
    }  
  }
  
?>

      <article class="article-section">

          <h1><?php echo $custName; ?></h1>
          <p class="back"><a href="<?php echo previousURL(); ?>">Back</a></p>
        <div class="box-container">

            <div class="box">
            <h4>Add Contact</h4>
            <div><?php echo $msg; ?></div>
            <form class="" action="" method="post">
             <div class="form-group">     
                
                <input class="form-control" type="text" name="fname" placeholder="First Name"/><br>
                
                <input class="form-control" type="text" name="lname" placeholder="Last Name"/><br>
                
                <input class="form-control" type="email" name="email" placeholder="Email"/><br>
              
                <input class="form-control" type="number" name="phone" placeholder="Phone Number"/><br>
                
                <input class="form-control" type="text" name="job_title" placeholder="Job Title"/><br>
             
                <input class="btn btn-primary pull-right" type="submit" name="submit" value="Add">
                <p><a href="customer_create.php"><?php echo $backLink; ?></a></p>
              </div>
            </form>
            
            </div>

        </div>

      </article>

    </main>
</div>
</body>

</html>
