<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<?php 		

if (isset($_GET['edit'])) {
		$id = $_GET['edit'];
		$update = true;
		$record = mysqli_query($createdb, "SELECT * FROM form_data WHERE id=$id");

		if (count($record) == 1 ) {
			$n = mysqli_fetch_array($record);
			$name = $n['name'];
			$email = $n['email'];
			$website = $n['website'];
			$address = $n['address'];
			$gender = $n['gender'];
			$password = $n['password'];
		}
	}
?>
// newly added field
<input type="hidden" name="id" value="<?php echo $id; ?>">

// modified form fields
<form method="post" action="connection.php">  
  Name: <input type="text" name="name" value="<?php echo $name;?>">
  <span class="error">* <?php echo $nameErr;?></span>
  <br><br>
  E-mail: <input type="email" name="email" value="<?php echo $email;?>">
  <span class="error">* <?php echo $emailErr;?></span>
  <br><br>

  Website: <input type="text" name="website" value="<?php echo $website;?>">
  <span class="error"><?php echo $websiteErr;?></span>
  <br><br>
  Address: <input type="text" name="address" value="<?php echo $address;?>">
   <span class="error"><?php echo $address_err;?></span>
  <br><br>
  Gender:
  <input type="radio" name="gender" <?php if (isset($gender) && $gender=="female") echo "checked";?> value="female">Female
  <input type="radio" name="gender" <?php if (isset($gender) && $gender=="male") echo "checked";?> value="male">Male
  <input type="radio" name="gender" <?php if (isset($gender) && $gender=="other") echo "checked";?> value="other">Other  
  <span class="error">* <?php echo $genderErr;?></span>
  <br><br>
  <button class="btn" type="submit" name="update" style="background: #556B2F;" >update</button>
</form>

</body>
</html>

