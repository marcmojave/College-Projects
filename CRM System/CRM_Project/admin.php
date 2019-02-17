<?php 
    require('header.php');
    
    //test if session username exists, otherwise redirect back to login
    sessionExists();
    
    //get current URL & save into SESSION variable
    //Can then use it in next pages to create a back hyperlink
    sendURL();
    
    $customerid = $_GET['id'];
    
    //get ID from URL, if no ID redirect back to the manage customer page
    getURLID();
   //Displays the name of a customer based on the customer ID provided
    $custName = displayName($customerid);
    
      
?>

      <article class="article-section">

          <h2><?php echo $custName; ?></h2>
        <div class="box-container">
            <p class="back"><a href="<?php echo previousURL2(); ?>">Back</a></p>
            <div class="box">
              <h4>Manage Customer</h4>
              <p><a href="customer_edit.php?id=<?php echo $customerid; ?>">Edit Customer</a></p>
              <p><a href="contact_edit.php?id=<?php echo $customerid; ?>">Edit Contact</a></p>
              <p><a href="contact_add.php?id=<?php echo $customerid; ?>">Add Contact</a></p>
              <p><a href="job_add.php?id=<?php echo $customerid; ?>">Add Jobs</a></p>
              
            </div>
        </div>

      </article>

    </main>
</div>
</body>

</html>
