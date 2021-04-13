<?php
   // Process delete operation after confirmation
   if(isset($_GET["id"]) && !empty($_GET["id"])){
       // Include config file
       include "conn.php";
       $id = $_GET["id"];
       // Prepare a delete statement
       $sql = "DELETE FROM form_data WHERE id = $id";
       
       if($stmt = mysqli_prepare($conn, $sql)){
           // Bind variables to the prepared statement as parameters
           mysqli_stmt_bind_param($stmt, "i", $param_id);
           
           // Set parameters
           $param_id = trim($id);
           
           // Attempt to execute the prepared statement
           if(mysqli_stmt_execute($stmt)){
               // Records deleted successfully. Redirect to landing page
               header("location: Read.php");
               exit();
           } else{
               echo "Oops! Something went wrong. Please try again later.";
           }
       }
        
       // Close statement
       mysqli_stmt_close($stmt);
       
       // Close connection
       mysqli_close($conn);
   }
   ?>