<?php

$sql = "SELECT * FROM contact where customer_id='". $customerid ."'";7

SELECT customer.name, customer.county, contact.fname, contact.lname FROM `customer`
inner join contact
on customer.customer_id = contact.customer_id;

//shows me all cusstomers whether ethy have a contact or not 
SELECT customer.name, customer.address1, customer.address2, customer.address3, customer.county, contact.fname, contact.lname FROM `customer`
left join contact
on customer.customer_id = contact.customer_id

$sqlInsert = "insert into contact(fname, lname, email, phone, customer_id)";
$sqlInsert .= "values('".$fname."', '".$lname."', '".$email."', '".$phone."', '".$customerid."')";

//execute query
      $result = mysqli_query($con, $sqlInsert);
      //Check if a row has been inserted
      if (mysqli_affected_rows($con) > 0
      
//get last record inserted
$sql = "INSERT INTO MyGuests (firstname, lastname, email)
VALUES ('John', 'Doe', 'john@example.com')";

if (mysqli_query($con, $sql)) {
    $last_id = mysqli_insert_id($con);
}

?>