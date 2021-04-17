<?php
   include"conn.php";
     // if(isset($_POST['submit'])){
   // Taking all 5 values from the form data(input)
   $name =  $_POST['name'];
   $email = $_POST['email'];
   $website = $_POST['website'];
   $address = $_POST['address'];
   $gender = $_POST['gender'];
   $password = generate_password();
   $encpt_password= ($enc_pass);

   
         
   
     if (isset($_POST['submit']) && !empty($name) && !empty($email) && !empty($website) && !empty($address) && !empty($gender) && !empty($password)) {
        # code...
     
   // Performing insert query execution
       $sql = "INSERT INTO form_data (name, email, website, address, gender, password) VALUES ('$name', '$email','$website','$address','$gender' , '$password')";
   
     }
   if(mysqli_query($conn, $sql)){
    header("location: Read.php");
   exit();
   } else{
      header("location: form.php");
       echo "ERROR: Hush! Sorry $sql. " 
           . mysqli_error($conn);
   }
   // }
   // Close connection
   mysqli_close($conn);
?>