<!DOCTYPE html>
<html>
   <head>
      <title>Form validation</title>
      <style>
         .error {color: #FF0000;}
         </style>
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
   </head>
   <body>
      <?php
// define variables and set to empty values
$nameErr = $emailErr = $genderErr = $websiteErr = $passErr = "";
$name = $email = $gender = $comment = $website = $password ="";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["name"])) {
    $nameErr = "Name is required";
  } else {
    $name = test_input($_POST["name"]);
    // check if name only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z-' ]*$/",$name)) {
      $nameErr = "Only letters and white space allowed";
    }
  }
  
  if (empty($_POST["email"])) {
    $emailErr = "Email is required";
  } else {
    $email = test_input($_POST["email"]);
    // check if e-mail address is well-formed
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $emailErr = "Invalid email format";
    }
  }
  if (empty($_POST["password"])) {
    $password = "";
  } else {
    $password = test_input($_POST["password"]);
    // check if URL address syntax is valid (this regular expression also allows dashes in the URL)
    if (!preg_match("(?=^(?:[^A-Z]*[A-Z]){2})(?=^(?:[^a-z]*[a-z]){2})(?=^(?:\D*\d){2})(?=^(?:\w*\W){2})^[A-Za-z\d\W]{8,}$",$password)) {
      $passErr = "Invalid URL";
    }
  }

    
  if (empty($_POST["website"])) {
    $website = "";
  } else {
    $website = test_input($_POST["website"]);
    // check if URL address syntax is valid (this regular expression also allows dashes in the URL)
    if (!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$website)) {
      $websiteErr = "Invalid URL";
    }
  }


  if (empty($_POST["gender"])) {
    $genderErr = "Gender is required";
  } else {
    $gender = test_input($_POST["gender"]);
  }
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>
      <div class="head">
         <div class="heading text-center bg-success text-white">
            <h2>Login form </h2>
         </div>

         <form class="form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">

            <p><span class="error">* required field</span></p>

            <div class="form-group">
                <label for="name" class="col-sm-2 col-form-label">Name:</label>
                  <div class="col-sm-10">
                      <span class="error">* <?php echo $nameErr;?></span>
                      <input type="text" class="form-control"  id="name"  placeholder="Enter your name" ><?php echo $_POST['name']; ?>
                  </div>
            </div>

             <div class="form-group">
                <label for="email" class="col-sm-2 col-form-label">E-mail:</label>
                  <div class="col-sm-10">
                      <span class="error">* <?php echo $emailErr;?></span>
                      <input type="email" class="form-control"  id="mail"  placeholder="Enter your email" ><?php echo $_POST['email']; ?>
                  </div>
            </div>

            <div class="form-group">
                <label for="password" class="col-sm-2 col-form-label">Password:</label>
                  <div class="col-sm-10">
                      <span class="error">* <?php echo $passErr;?></span>
                      <input type="password" class="form-control"  id="password"  placeholder="Enter your password" ><?php echo $_POST['password']; ?>
                  </div>
            </div>

             <div class="form-group">
                <label for="website" class="col-sm-2 col-form-label">Website:</label>
                  <div class="col-sm-10">
                      <span class="error">* <?php echo $websiteErr;?></span>
                      <input type="text" class="form-control"  id="website"  placeholder="Enter your website" ><?php echo $_POST['website']; ?>
                  </div>
            </div>
             <div class="form-group">
                <span class="error">* <?php echo $genderErr;?></span>
                 <label for="website" class="col-sm-2 col-form-label">Gender:</label>
                  <div class="form-check">
                     <input type="radio" name="gender" <?php if (isset($gender) && $gender=="female") echo "checked";?> value="female">Female
                     <input type="radio" name="gender" <?php if (isset($gender) && $gender=="male") echo "checked";?> value="male">Male
                     <input type="radio" name="gender" <?php if (isset($gender) && $gender=="other") echo "checked";?> value="other">Other 
            </div>
           
           <button type="submit" class="btn btn-primary">Submit</button>
      </div>
      </form>
   </body>
</html>