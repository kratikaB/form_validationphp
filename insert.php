<?php
   include"conn.php";
     if(isset($_POST['submit'])){
   // Taking all 5 values from the form data(input)
   $name =  $_REQUEST['name'];
   $email = $_REQUEST['email'];
   $website = $_REQUEST['website'];
   $address = $_REQUEST['address'];
   $gender = $_REQUEST['gender'];
   $password = generate_password();
   $encpt_password= ($enc_pass);
   
     if ($_POST['']) {
        # code...
     }
   // Performing insert query execution
       $sql = "INSERT INTO form_data (name, email, website, address, gender, password) VALUES ('$name', '$email','$website','$address','$gender' , '$password')";
   
     
   if(mysqli_query($conn, $sql)){
    header("location: Read.php");
   exit();
   } else{
       echo "ERROR: Hush! Sorry $sql. " 
           . mysqli_error($conn);
   }
   }
   // Close connection
   mysqli_close($conn);
   ?>