<?php  
    //require the public header which starts a session and connects to the database
     require('header.php');
     
     
    //3. If the form is submitted or not.
    //3.1 If the form is submitted
    if (isset($_POST['username']) and isset($_POST['password'])){
        //3.1.1 Assigning posted values to variables.
        $username = mysqli_real_escape_string($con, $_POST['username']);
        $password = mysqli_real_escape_string($con, $_POST['password']);
        
        //3.1.2 Checking the values are existing in the database or not
       $query = "SELECT * FROM `user` WHERE username='$username'";
        
        $result = mysqli_query($con, $query) or die(mysqli_error($con));
        
        $resultPassword = mysqli_query($con, $query) or die(mysqli_error($con));
        $count = mysqli_num_rows($result);
        
       //getting the hashed password from the database
        while ($row=mysqli_fetch_array($resultPassword)){
                $hashPassword = $row['password'];
                
        }
        
      
        
        //3.1.2 If the posted values are equal to the database values, then session will be created for the user.
        if ($count == 1 && password_verify($password, $hashPassword)){//pw_verify function compares entered passwword with the hashed one in DB
            $_SESSION['un'] = $username;
            
            //Get the user ID for use for other areas of the site
            while ($row=mysqli_fetch_array($result)){
                  $userid = $row['user_id'];
                  $username = $row['username'];
                  $admin = $row['admin'];
            }
            //assign userid to session array
            $_SESSION['user_id'] = $userid;
            $_SESSION['admin'] = $admin;
        }else{
            //3.1.3 If the login credentials doesn't match, he will be shown with an error message.
            $fmsg = "Invalid Login Credentials.";
        }
    }
    
    
     //3.1.4 if the user is logged in Greets the user with message
    if (isset($_SESSION['un'])){
        
       echo "Welcome $username";
        //Redirects to the Create customer screen after 2 seconds.
        if($_SESSION['admin'] == 'a'){
         header("Refresh:1; url=index.php");
        }else{
         header("Refresh:1; url=customer_search.php");
        }
        
    }else{
//3.2 When the user visits the page first time, simple login form will be displayed.
?>

 <article class="article-section">

          
          <h2><?php echo $msg; ?></h2>
        <div class="box-container">
        
            <div class="box">
             <h4>Login</h4> 
             
              <form action="" method="post">
                <div class="form-group">
                 <div class="alert alert-danger" role="alert"> <?php echo $fmsg; ?> </div>
                  <input class="form-control" type="text" name="username" placeholder="Username" autocomplete="off">
                  </br>
                  <input class="form-control" type="password" name="password" placeholder="Password" autocomplete="off">
                  </br>
                
                  
                  <br>
                  <input class="btn btn-primary pull-right" type="submit" name="submit" value="Login">
                </div>
              </form>
                
            </div>

        </div>

      </article>
    
    </body>
    
</html>

<?php } ?>

