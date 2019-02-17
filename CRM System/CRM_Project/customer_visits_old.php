<?php require('header.php');

  //test if session username exists, otherwise redirect back to login
    sessionExists();
  //assign function to variable
  $oldJobs = allJobsOrderedOld();
  //get URL of previus page
  previousURL2();
  
  if ($_GET['submit']){
      $numDays =  $_GET['num_days'];
  }

?>

      <article class="article-section">

          <h2>Oldest Jobs</h2>
          <p class="back"><a href="<?php echo previousURL2(); ?>">Back</a></p>
        <div class="box-container">
             <div class="box">
             <form class="form-group" action="" method="get">
               <h4>Show Jobs Greather Than</h4>
               <input class="form-control" type="number" name="num_days" placeholder="Fiter by Number of Days"/><br>
               <input type="submit" name="submit" value="Filter" class="btn btn-primary pull-left"/>
             </form>
              
            </div>
            <div class="box">
            <h4>Oldest Jobs</h4>
              <table class="table">
              <th>Name</th>
              <th>Knives</th>
              <th>Days</th>
              <?php 
                    while($row=mysqli_fetch_array($oldJobs)){
                      if (subtractFromTodaysDate(fmtDate($row['date'])) > $numDays){
                        
                        echo "<tr><td><a href='customer_overview.php?id=".$row['customer_id']."'>".ucwords($row['name'])."</a></td>";
                        echo "<td>".$row['knives']."</td>"; 
                        echo "<td>".subtractFromTodaysDate(fmtDate($row['date']))."</td></tr>"; 
                      }     
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
