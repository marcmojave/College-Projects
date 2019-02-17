<script>
  
  document.addEventListener('DOMContentLoaded', function(){
    var addBtn = document.getElementById('add');
    var name = document.getElementById('name');
    var county = document.getElementById('county');
    addBtn.disabled = true;
    
    county.addEventListener('change', function(){
      
         if(county.value == "" || name.value == ""){
            addBtn.disabled = true;
        }else{
            addBtn.disabled = false;
    }
      
    });
    
  });
</script>
<?php

//<form class="form-horizontal"   method="get" autocomplete="off">

      //execute query
      $result = mysqli_query($con, $sqlInsert);
      //Check if a row has been inserted
      if (mysqli_affected_rows($con) > 0
      
      ($_SERVER['REQUEST_METHOD'] == 'POST'){
          
      };
      
      //shortnand for if else
      echo empty($test) ? 'empty' : $test;
      ?>
      
       <?php $row=mysqli_fetch_array($result); ?>
                <input type='text' name='name' id='name' value= 'empty($name) ? $name :'".$row[name]."'/><br>
                    <input type='text' name='address1' value= '".$row[address1]."'/><br>
                    <input type='text' name='address2' value= '".$row[address2]."'/><br>
                    <input type='text' name='address3' value= '".$row[address3]."'/><br>
                    <input type='hidden' id='hidden' value='".$row[county]."'>";