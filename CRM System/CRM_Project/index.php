<?php 

  require('header.php');
  
   //test if session username exists, otherwise redirect back to login
   sessionExists(); 
   
   //prevent access to admin pages by redirecting back to customer_search
   checkAdmin();

  //will grap the current URL and save into SESSION variable
   sendURL();
   sendURL2();
  //Assign result from function to variable
  $oldJobs = oldJobs();

?>

      <article class="article-section">

          <h2>Dashboard</h2>
        <div class="box-container">

            <div class="box">
              <h4><a href="customer_search.php">Overview</a></h4>
                <table class="table">
                    <tr>
                       <td><b>Total Customers</b></td><td><?php echo ttlCustomers(); ?></td>
                    </tr>
                    <tr>
                        <td><b>Total Knives</b></td><td><?php echo ttlKnives(); ?></td>
                    </tr>
                     <tr>
                        <td><b>Total Jobs</b></td><td><?php echo ttlJobsOverall(); ?></td>
                    </tr>
                </table>
            </div>
            <div class="box">
              <h4>Top 5 Customers</h4>
              <table class="table">
                <th>Name</th><th>Knives</th>
              <?php $top5Customers = top5Customers();
              while($row=mysqli_fetch_array($top5Customers)){
                            echo "<tr><td><a href='customer_overview.php?id=".$row['customer_id']."'>".ucwords($row['name'])."</a></td>";
                            echo "<td>".$row['knives']."</td></tr>";
                        }; ?>
              </table>
            </div>
            <div class="box">
            <h4><a href="customer_visits_old.php">Most Days Since Last Job</a></h4>
            <table class="table">
              <th>Name</th>
              <th>Knives</th>
              <th>Days</th>
              <?php 
                    while($row=mysqli_fetch_array($oldJobs)){
                          echo "<tr><td><a href='customer_overview.php?id=".$row['customer_id']."'>".ucwords($row['name'])."</a></td>";
                          echo "<td>".$row['knives']."</td>"; 
                          echo "<td>".subtractFromTodaysDate(fmtDate($row['date']))."</td></tr>"; 
                           
                    }
                ?>
            </table>
            </div>
        </div>

      </article>

    </main>
</div>
</body>

</html>
