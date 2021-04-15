<!DOCTYPE HTML>  
<html>
   <head>
      <style>
         .error {color: #FF0000;}
      </style>
   </head>
   <body>
      <?php
         // define variables and set to empty values
         $nameErr = $emailErr = $genderErr = $address_err = $websiteErr = "";
         $name = $email = $gender = $address = $website = "";
         
         // if ($_SERVER["REQUEST_METHOD"] == "POST") {
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
            
           if (empty($_POST["website"])) {
             $website = "";
           } else {
             $website = test_input($_POST["website"]);
             // check if URL address syntax is valid (this regular expression also allows dashes in the URL)
             if (!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$website)) {
               $websiteErr = "Invalid URL";
             }
           }
         
             
             if(empty($_POST["address"])){
             $address="";
            } else{
               $address = test_input($_POST["address"]);
               if (!preg_match("/[A-Za-z0-9\-\\,.]+/",$address)){ 
               $address_err = "Please enter an address.";     
             }
          }
                 
         
           if (empty($_POST["gender"])) {
             $genderErr = "Gender is required";
           } else {
             $gender = test_input($_POST["gender"]);
           }
         // }
         
         function test_input($data) {
           $data = trim($data);
           $data = stripslashes($data);
           $data = htmlspecialchars($data);
           return $data;
         }
         ?>
      <h2>PHP Form Validation Example</h2>
      <p><span class="error">* required field</span></p>
      <form method="POST" action="insert.php">  
         Name: <input type="text" name="name" value="<?php echo $name;?>">
         <span class="error">* <?php echo $nameErr;?></span>
         <br><br>
         E-mail: <input type="email" name="email" value="<?php echo $email;?>">
         <span class="error">* <?php echo $emailErr;?></span>
         <br><br>
         Website: <input type="text" name="website" value="<?php echo $website;?>">
         <span class="error"><?php echo $websiteErr;?></span>
         <br><br>
         Address: <textarea rows="5" name="address" value="<?php echo $address;?>"></textarea>
         <span class="error"><?php echo $address_err;?></span>
         <br><br>
         Gender:
         <input type="radio" name="gender" <?php if (isset($gender) && $gender=="female") echo "checked";?> value="female">Female
         <input type="radio" name="gender" <?php if (isset($gender) && $gender=="male") echo "checked";?> value="male">Male
         <input type="radio" name="gender" <?php if (isset($gender) && $gender=="other") echo "checked";?> value="other">Other  
         <span class="error">* <?php echo $genderErr;?></span>
         <br><br>
         <input type="submit" name="submit" value="submit">  
      </form>
   </body>
</html>