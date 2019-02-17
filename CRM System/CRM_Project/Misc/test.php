
<!DOCTYPE html>
<html>
<body>
    
    

<script src="jquery.js"></script>
<script src="jquery.js">
    var text = document.getElementById('text1').value;
    $(document).ready(function() {
       $.ajax({
           type: "post",
           url: "test.php",
           data: {e : text},
           success: function (response){
               alert("success");
           }
       });
       
    });
</script>


<form method="post" id="myFormName" name="myFormName">
    <input type="text" name="" id="text1"/>
    <input type="text" name="" id="text2"/>
    <input type="submit" name="submit" value="submit"/>
</form>

</body>

    
</html>
