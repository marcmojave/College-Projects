<?php require('header.php');
   
   //test if session username exists, otherwise redirect back to login
   sessionExists();
   
   //Call function to get URL ID 
   $customerid = getURLID();
    //create counter to track number of contacts
    $i = 0;
    //get contacts belonging to customer
    $sql = "SELECT * FROM contact where customer_id='". $customerid ."'";
 
 
    $result = mysqli_query($con, $sql);
 
    //call function to display customer name
    $custName = displayName($customerid);
 
 //check if any rows have been returned from select query
    if (mysqli_num_rows($result) != 0){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){ //check if form has been posted
            //Get vaues from the POST array
            $contactid = mysqli_real_escape_string($con, $_POST['contactid']);
            $fname = mysqli_real_escape_string($con, $_POST['fname']);
            $lname = mysqli_real_escape_string($con, $_POST['lname']);
            $email = mysqli_real_escape_string($con, $_POST['email']);
            $phone = mysqli_real_escape_string($con, $_POST['phone']);
            //check if Save has been clicked
            if (isset($_POST['save'])){
                //print_r($_POST);
                if (!empty($_POST['fname']) || !empty($_POST['lname'])){ //check for first or last name
                    
                    //SQL to update customer table with new values
                     $sqlUpdate = "UPDATE contact SET fname='" .$fname. "',
                     lname='" .$lname. "',
                     email='" .$email. "',
                     phone='" .$phone. "'
                     where contact_id='". $contactid ."'";
                    $resultUpdate = mysqli_query($con, $sqlUpdate);
                    if(mysqli_affected_rows($con)){
                        $msg = "Updated successfully";
                    }
                }else{
                    $msg = "Please enter a first or last name";
                }
            }
            //check if delete was clicked
            if (isset($_POST['delete'])){
                //getting contact ID from the POST array
               
               $sql = "DELETE FROM contact WHERE contact_id='". $contactid ."'";
               $resultDelete = mysqli_query($con, $sql);
               if (mysqli_affected_rows($con) > 0){
                   $msg = "Deleted successfully";
               }else{
                   $msg = "Not Deleted";
               }
            }
        }
    }else{ //Display the following if no contacts set up
        echo "No contacts set up for this customer";
        echo "<br>";
        echo "<a href='contact_add.php?id=$customerid'>Add Contact</a>"; 
    }
?>

      <article class="article-section">

          <h2><?php echo $custName; ?></h2>
          <p class="back"><a href="<?php echo previousURL(); ?>">Back</a><p>
        <div class="box-container">
            <?php

                //loop throw & display contact details
            while($row=mysqli_fetch_array($result)):; ?>
                     <div class="box">
                    <h4><?php echo "Contact " . $i+=1;?></h4>
                    <div><?php echo $msg; ?></div>
                <form action="" method="post">
                    <div class="form-group"> 
                        <input type="hidden" name="contactid" value="<?php echo $row['contact_id']; ?>">
                        <input class="form-control" type="text" name="fname" value="<?php echo showNewVal(htmlspecialchars($fname), htmlspecialchars($row['fname'])); ?>"/><br>
                        <input class="form-control" type="text" name="lname" value="<?php echo showNewVal(htmlspecialchars($lname), htmlspecialchars($row['lname'])); ?>"/><br>
                        <input class="form-control" type="text" name="email" value="<?php echo showNewVal(htmlspecialchars($email), htmlspecialchars($row['email'])); ?>"/><br>
                        <input class="form-control" type="number" name="phone" value="<?php echo showNewVal(htmlspecialchars($phone), htmlspecialchars($row['phone'])); ?>"/><br>
                        <input class="btn btn-primary pull-left" type="submit" name="save" id="savebtn" value="Save"/>
                        <input class="btn btn-primary pull-right" type="submit" name="delete" id="deletebtn" value="Delete"/>
                    </div>
                </form>
            </div>
            <?php endwhile; ?>
            
            
        </div>

      </article>

    </main>
</div>
</body>

</html>
