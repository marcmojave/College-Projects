<?php 
  
    require('header.php');
    
    
    if ($_SESSION['admin'] == 'a'){
        $pageName = 'customer_overview';
        $text = 'View';
    }else{
        $pageName = 'admin';
        $text = 'Edit';
    }
    //test if session username exists, otherwise redirect back to login
    sessionExists();
    
    //will grap the current URL and save into SESSION variable
    sendURL2();
   
   $sql = "SELECT job_id, customer_id, name, address1, address2, address3, county, fname, lname, phone, email";
            $sql .= " FROM all_customer_1_contact";
         
    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        if (isset($_POST['search']) && !empty($_POST['search'])){ //check search has a value
            $search = mysqli_real_escape_string($con, $_POST['search']);
            $sqlSearch = "SELECT * FROM all_customer_1_contact WHERE name LIKE '$search%'";
            $resultSearch = mysqli_query($con, $sqlSearch);
            //array returnedis to be put into $result to be used in loop below
            
                $result = $resultSearch;
               
        }else{
            if ($_POST['submit'] == 'submit'){
                $msg = "No search word entered"; //only show this message when Search is clicked not reset
            }else{
                $msg = "";
            }
            
            //if no search, display all records from all_customer_1_contac (just show one contact per person)
            $resultSelect = mysqli_query($con, $sql);
            $result = $resultSelect;
        }
        
    }else{  
        
            //if no search, display all records from all_customer_1_contac (just show one contact per person)
            $resultSelect = mysqli_query($con, $sql);
            $result = $resultSelect;
        
    }
    
?>

      <article class="article-section">

          <h2>Customer List</h2>
        <div class="box-container">
            <div class="box">
                <h4>Search</h4>
                <div><?php echo $msg; ?></div>
                <form action="" method="post">
                   <div class="form-group">
                        <input type="text" name="search" value="" id="search" class="form-control" autocomplete="off" placeholder="Search Customer Name"/><br>
                        <input type="submit" value="Search" class="btn btn-primary pull-left"/>
                        <input type="submit" value="Reset" name="reset" class="btn btn-primary pull-right"/>
                    </div>
                </form>
            </div>
            <div class="box">
            <h4>Customers</h4>
            <table class="table">
                <tr>
                    <th>Name</th>
                    <th>Address 1</th>
                    <th>Address 2</th>
                    
                    <th>County</th>
                    <th>Contact</th>
                    <th>Phone</th>
                    
                    <th>Job</th>
                    <th><?php echo ucwords($text); ?></th>
                    
                   
                </tr>
                <?php while($row=mysqli_fetch_array($result)):; ?>
                <tr>
                    <?php if(isset($row['job_id'])){
                            $job = 'Yes';
                    }else{
                            $job = 'No';
                    };?>
                    <td><?php echo ucwords($row['name']); ?></td>
                    <td><?php echo ucwords($row['address1']); ?></td>
                    <td><?php echo ucwords($row['address2']); ?></td>
                    
                    <td><?php echo $row['county']; ?></td>
                    <td><?php echo ucwords($row['fname'] ." ".$row['lname']); ?></td>
                    <td><?php echo $row['phone']; ?></td>
                    <td><?php echo $job; ?></td>
                   <td><a href="<?php echo $pageName; ?>.php?id=<?php echo $row['customer_id']; ?>"><?php echo $text?></a></td>
                   
                   <!--Hiding the Admin link for now until I decide what to do with it-->
                    <td hidden="true"><a href="admin.php?id=<?php echo $row['customer_id']; ?>">Edit</a></td>
                    
                 
                </tr>
                <?php endwhile; ?>
            </table>
            </div>
            
        </div>

      </article>

    </main>
</div>
</body>

</html>
