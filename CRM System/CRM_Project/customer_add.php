<?php 
  
  //connect to header.php
  require('header.php'); 
  //test if session username exists, otherwise redirect back to login
  sessionExists();
  //check if form has bee submitted
  if (isset($_POST['submit'])){
    
    if (empty($_POST['name']) || empty($_POST['county'])){
    
        $msg = 'Must provide a value for Name & County';
    

  }else{
        //save post values into variables after using escape function
        $name = mysqli_real_escape_string($con, $_POST['name']);
        $email = mysqli_real_escape_string($con, $_POST['email']);
        $address1 = mysqli_real_escape_string($con, $_POST['address1']);
        $address2 = mysqli_real_escape_string($con, $_POST['address2']);
        $address3 = mysqli_real_escape_string($con, $_POST['address3']);
        $county = $_POST['county'];
        
          //create insert query for customer table
        $sqlCustomer = "INSERT INTO customer(name, email, address1, address2, address3, county)";
        $sqlCustomer .= " VALUES('".$name."', '".$email."', '".$address1."', '".$address2."', '".$address3."', '".$county."')";
        //execute query
        
        $result = mysqli_query($con, $sqlCustomer);
            //check if a row has been inserted
           if (mysqli_affected_rows($con) == 1){
             
             //get the ID of the last record inserted
              $lastID = mysqli_insert_id($con);
              $msg = 'Record updated successfully';
              $addContactMsg = 'Click here for Customer dashboard';      
          }
        
  }
}
?>

      <article class="article-section">

          
          
        <div class="box-container">
        
            <div class="box">
             <h4>Create Customer</h4> 
             <div><?php echo $msg; ?></div>
              <form action="" method="post" id="frm_create_cust">
                <div class="form-group">
                  
                  <input class="form-control" type="text" name="name" id="name" placeholder="Name">
                 </br>
                  <input class="form-control" type="text" name="address1" placeholder="address1">
                  </br>
                  <input class="form-control" type="text" name="address2" placeholder="address2">
                  </br>
                  <input class="form-control" type="text" name="address3" placeholder="address3">
                  </br>
                  <select class="form-control" name="county" id="county">
                    <option value="">County</option>
                   <?php foreach(counties() as $county){ //function returns array - loop through to get counties
                            echo "<option>$county</option>"; 
                         }; ?>
                  </select>
                  
                  <br>
                  <input class="btn btn-primary pull-right" type="submit" name="submit" value="Add">
                </div>
              </form>
                <?php echo  "<P><a href='customer_overview.php?id=$lastID'>$addContactMsg</a></P>";  ?>
            </div>

        </div>

      </article>

    </main>
</div>
</body>

</html>
