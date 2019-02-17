<?php
    require('header.php');
    
    
    
    $un = mysqli_real_escape_string($con, $_POST['username']);
    $password = mysqli_real_escape_string($con, $_POST['password']);
    $user_type = mysqli_real_escape_string($con, $_POST['user_type']);
    
    $hashPassword = password_hash($password, PASSWORD_DEFAULT);
    
    
   
    $query = "INSERT INTO `user` (username, password, admin) VALUES ('".$un."', '".$hashPassword."', '".$user_type."')";
     
     if(isset($_POST['submit'])){
         echo $_POST[''];
         if(empty($un) || (empty($password) || empty($user_type))){
            $msg = "All fields mut be complete"; 
         }else{
             
                mysqli_query($con, $query);
                if(mysqli_affected_rows($con) > 0){
                    $msg = "User successfully added";
                }else{
                    $msg = "User could not be added";
                } 
             
         }
       
     }       
 
            
    
?>
<article class="article-section">
    <div class="box-container">
    
        <div class="box">
            <h4>Add User</h4>
            <div><?php echo $msg; ?></div>
            <form action="" method="post">
                <div class="form-group"> 
                    <input class="form-control" type="text" name="username" placeholder="Username" autocomplete="off"/><br>
                    <input class="form-control" type="password" name="password" placeholder="Password" autocomplete="off"/><br>
                    <label>Admin</label>
                    <select class="form-control" name="user_type">
                        <option value="">Select</option>
                        <option value="y">Yes</option>
                        <option value="n">No</option>
                    </select><br>
                    <input class="btn btn-primary pull-left" type="submit" name="submit" value="Add"/>
                </div>
            </form>
        </div>
    </div>
</article>
    </main>

</body>

</html>
