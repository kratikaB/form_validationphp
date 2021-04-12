<?php
   // Include config file
   include "conn.php";
    
   // Define variables and initialize with empty values
   $nameErr = $emailErr = $genderErr = $address_err = $websiteErr = "";
   $name = $email = $gender = $address = $website = "";
    
   // Processing form data when form is submitted
   if(isset($_POST["id"]) && !empty($_POST["id"])){
       // Get hidden input value
       $id = $_POST["id"];
       
       // Validate name
       $input_name = trim($_POST["name"]);
       if(empty($input_name)){
           $name_err = "Please enter a name.";
       } elseif(!filter_var($input_name, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
           $name_err = "Please enter a valid name.";
       } else{
           $name = $input_name;
       }
       
       // Validate address address
       $input_address = trim($_POST["address"]);
       if(empty($input_address)){
           $address_err = "Please enter an address.";     
       } else{
           $address = $input_address;
       }
       
      
       // Check input errors before inserting in database
       if(empty($name_err) && empty($address_err) && empty($emailErr)) && empty($websiteErr)) && empty($genderErr)
           // Prepare an update statement
           $sql = "UPDATE form_data SET name=?, email=?, address=?, website=?, gender=? WHERE id=?";
            
           if($stmt = mysqli_prepare($conn, $sql)){
               // Bind variables to the prepared statement as parameters
               mysqli_stmt_bind_param($stmt, "sssi", $param_name, $param_email $param_address, $param_website, $param_gender, $param_id);
               
               // Set parameters
               $param_name = $name;
               $param_email =$email;
               $param_address = $address;
               $param_website = $website;
               $param_gender = $gender;
               $param_id = $id;
               
               // Attempt to execute the prepared statement
               if(mysqli_stmt_execute($stmt)){
                   // Records updated successfully. Redirect to landing page
                   header("location: database.php");
                   exit();
               } else{
                   echo "Oops! Something went wrong. Please try again later.";
               }
           }
            
           // Close statement
           mysqli_stmt_close($stmt);
       }
       
       // Close connection
       mysqli_close($conn);
   } else{
       // Check existence of id parameter before processing further
       if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
           // Get URL parameter
           $id =  trim($_GET["id"]);
           
           // Prepare a select statement
           $sql = "SELECT * FROM employees WHERE id = ?";
           if($stmt = mysqli_prepare($conn, $sql)){
               // Bind variables to the prepared statement as parameters
               mysqli_stmt_bind_param($stmt, "i", $param_id);
               
               // Set parameters
               $param_id = $id;
               
               // Attempt to execute the prepared statement
               if(mysqli_stmt_execute($stmt)){
                   $result = mysqli_stmt_get_result($stmt);
       
                   if(mysqli_num_rows($result) == 1){
                       /* Fetch result row as an associative array. Since the result set
                       contains only one row, we don't need to use while loop */
                       $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                       
                       // Retrieve individual field value
                       $name = $row["name"];
                       $email = $row["email"];
                       $website = $row["website"];
                       $address = $row["address"];
                       $gender = $row["gender"];
                   } else{
                       // URL doesn't contain valid id. Redirect to error page
                       exit();
                   }
                   
               } else{
                   echo "Oops! Something went wrong. Please try again later.";
               }
           }
           
           // Close statement
           mysqli_stmt_close($stmt);
           
           // Close connection
           mysqli_close($conn);
       }  else{
           // URL doesn't contain id parameter. Redirect to error page
          
           exit();
       }
   }
   ?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <title>Update Record</title>
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
      <style>
         .wrapper{
         width: 600px;
         margin: 0 auto;
         }
      </style>
   </head>
   <body>
      <div class="wrapper">
         <div class="container-fluid">
            <div class="row">
               <div class="col-md-12">
                  <h2 class="mt-5">Update Record</h2>
                  <p>Please edit the input values and submit to update the employee record.</p>
                  <form action="database.php" method="post">
                     <div class="form-group">
                        <label>Name</label>
                        <input type="text" name="name" class="form-control <?php echo (!empty($name_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $name; ?>">
                        <span class="invalid-feedback"><?php echo $name_err;?></span>
                     </div>
                     <div class="form-group">
                        <label>Address</label>
                        <textarea name="address" class="form-control <?php echo (!empty($address_err)) ? 'is-invalid' : ''; ?>"><?php echo $address; ?></textarea>
                        <span class="invalid-feedback"><?php echo $address_err;?></span>
                     </div>
                     <div class="form-group">
                        <label>Salary</label>
                        <input type="text" name="salary" class="form-control <?php echo (!empty($salary_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $salary; ?>">
                        <span class="invalid-feedback"><?php echo $salary_err;?></span>
                     </div>
                     <input type="hidden" name="id" value="<?php echo $id; ?>"/>
                     <input type="submit" class="btn btn-primary" value="Submit">
                     <a href="index.php" class="btn btn-secondary ml-2">Cancel</a>
                  </form>
               </div>
            </div>
         </div>
      </div>
   </body>
</html>