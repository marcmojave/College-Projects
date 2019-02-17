
<?php 
    require('header.php');
    //test if session username exists, otherwise redirect back to login
    sessionExists();
    
    sendURL2();
    $sql = "SELECT * FROM all_customer_1_contact GROUP BY name";
    $result = mysqli_query($con, $sql);
    
    //Filter results by county if selected by user
    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
       $countyChoice = $_POST['county'];
       //check for default option 
       if ($countyChoice != 'allcounties'){
           $sql = "SELECT * FROM all_customer_1_contact where county='" .$countyChoice. "' GROUP BY name";
           $result = mysqli_query($con, $sql);
       }else{
           $sql = "SELECT * FROM customer_jobs";
       }
           
    }
?>

      <article class="article-section">

          <h2>Customers by County</h2>
        <div class="box-container">
         <div class="box">
              <h4>Filter</h4>
              <form action="" method="post" name="frm" id="frm">
                  <div class="form-group"> 
                          <input type='hidden' name='hidden' id='hidden' value='<?php echo $countyChoice; ?>'/>
                        <select class="form-control" name="county" id="county">
                           
                            <option value="allcounties">All Counties</option>
                            <?php foreach(counties() as $county):; ?> 
                                <option value='<?php echo $county; ?>'><?php echo $county; ?></option>
                            
                            <?php endforeach; //end for each loop ?>
                                
                        </select><br>
                          <input class="btn btn-primary pull-left" type="submit" name="submit" value="Filter"/>
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
                    <th>Address 3</th>
                    <th>County</th>
                    <th>View</th>
                  
                </tr>
                <?php while($row=mysqli_fetch_array($result)):; ?>
                <tr>
                    <td><?php echo $_SESSION['name'] = ucwords($row['name']); ?></td>
                    <td><?php echo $row['address1']; ?></td>
                    <td><?php echo $row['address2']; ?></td>
                    <td><?php echo $row['address3']; ?></td>
                    <td><?php echo $row['county']; ?></td>
                    
                    <td><a href="customer_overview.php?id=<?php echo $row['customer_id']; ?>">View</a></td>
                   
                 
                </tr>
                <?php endwhile; ?>
            </table>
            </div>
            
        </div>

      </article>

    </main>
</div>
</body>
<script>
    //Only way I can change drop down value is through JS
    //Get the value of drop down on submit
    //pass that value to the value of a hidden field so JS can access it
    //set the value of the drop down to be value of hidden field
  
    var hideCounty = document.getElementById('hidden');
    var ctyDropdown = document.getElementById('county');
    
    ctyDropdown.value = hideCounty.value;
</script>
</html>
