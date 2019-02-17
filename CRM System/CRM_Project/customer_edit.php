<?php require('header.php');
  
  //test if session username exists, otherwise redirect back to login
  sessionExists();

 //Call function to get URL ID 
   $customerid = getURLID();
   
 //SQL to get customer details based on ID to display in form below
 $sql = "SELECT * FROM customer where customer_id='". $customerid ."'";

 //Execute the SQL
 $result = mysqli_query($con, $sql);
 //Run query with different variable name to get the name of customer
 $resultName = mysqli_query($con, $sql);
 
 //call function to display customer name
$custName = displayName($customerid);
 

    if (isset($_POST['submit'])){
        //must ba a value for name
        if (!empty($_POST['name'])){
            $name = mysqli_real_escape_string($con, $_POST['name']);
            $address1 = mysqli_real_escape_string($con, $_POST['address1']);
            $address2 = mysqli_real_escape_string($con, $_POST['address2']);
            $address3 = mysqli_real_escape_string($con, $_POST['address3']);
            $county = mysqli_real_escape_string($con, $_POST['county']);
            //SQL to update customer table with new values
            $sqlUpdate = "UPDATE customer SET name='" .$name. "',
             address1='" .$address1. "',
             address2='" .$address2. "',
             address3='" .$address3. "',
             county='" .$county. "'
             where customer_id='". $customerid ."'";
            $resultUpdate = mysqli_query($con, $sqlUpdate);
            if (mysqli_affected_rows($con) == 0){
                echo "Database Error, record not updated";
            }else{
                $msg = "Record updated successfully";
            }
        }else{
            $msg = "Enter a value for name.";
        }
    }

?>

      <article class="article-section">

          <h2><?php echo $custName; ?></h2>
          <p class="back"><a href="<?php echo previousURL(); ?>">Back</a></p>
        <div class="box-container">

            <div class="box">
            <h4>Customer Edit</h4>
            <form action="" method="post">
               <div class="form-group"> 
            
                <?php echo $msg; ?>
                    <?php $row=mysqli_fetch_array($result); ?>
                   <input class="form-control" type='text' name='name' value= '<?php showNewVal($name, $row['name']); //function checks for new valus & displays instead?> '/><br>
                   
                   <input class="form-control" type='text' name='address1' value= '<?php showNewVal(htmlspecialchars($address1), htmlspecialchars($row['address1'])); ?>'/><br>
                   
                   <input class="form-control" type='text' name='address2' value= '<?php showNewVal(htmlspecialchars($address2), htmlspecialchars($row['address2'])); ?>'/><br>
                   
                   <input class="form-control" type='text' name='address3' value= '<?php showNewVal(htmlspecialchars($address3), htmlspecialchars($row['address3'])); ?>'/><br>
                   
                   <input class="form-control" type='hidden' name='county' id='hidden' value='<?php showNewVal(htmlspecialchars($county), htmlspecialchars($row['county'])); ?>'/><br>
                        
                      
                    <select class="form-control" name='county' id='county'>
                        
                       <?php foreach(counties() as $county){ //function returns array - loop through to get counties
                                echo "<option value='$county'>$county</option>"; 
                             }; ?>
                    </select>
                    <br>
                    <input class="btn btn-primary pull-left" type='submit' name='submit' value='Save'/>
                </div>
            </form>
            
            
            </div>
            
        </div>

      </article>

    </main>
</div>
</body>

</html>
<script>
    //Only way I can change drop down value is through JS
    //Get the value of drop down on submit
    //pass that value to the value of a hidden field so JS can access it
    //set the value of the drop down to be value of hidden field
  
    var hideCounty = document.getElementById('hidden');
    var ctyDropdown = document.getElementById('county');
    
    ctyDropdown.value = hideCounty.value;
</script>