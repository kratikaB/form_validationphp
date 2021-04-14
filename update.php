<?php
include "conn.php"; 
if(isset($_POST['update']))
{         
        
    $id= $_GET['id'];
    $name =  $_POST['name'];
    $email = $_POST['email'];
    $website = $_POST['website'];
    $address = $_POST['address'];
    $gender = $_POST['gender'];

    $result = mysqli_query($conn, "UPDATE form_data SET name='$name', email='$email' , website='$website' , address='$address' , gender='$gender' WHERE id=$id");
        
     
    header("Location: Read.php");
}

?>
<?php

// $id = $_GET['id'];
    $id = $_GET['id'];

$result = mysqli_query($conn, "SELECT * FROM form_data WHERE id=$id");

 
while($n = mysqli_fetch_array($result))
{
            $name = $n['name'];
            $email = $n['email'];
            $website = $n['website'];
            $address = $n['address'];
            $gender = $n['gender'];
           
         
}
?>
<html>
<head>    
    <title>Edit Data</title>
</head>
 
<body>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">



<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

<div class="container">
    


<div class="row justify-content-center">
<div class="col-md-6">
    <a href="Read.php" class="float-right btn btn-outline-primary mt-1">Back</a>
    <h4 class="card-title mt-2">Update</h4>
</header>
</div>
</div>
</div>
  
    
        <form  method="post" action="">
    <table class="table table-bordred table-striped">
            <tr>
                <td>name</td>
                <td><input type="text" name="name" value="<?php echo $name;?>"></td>
            </tr>
            <tr>
                <td>email</td>
                <td><input type="email" name="email" value="<?php echo $email;?>"></td>
            </tr>
            <tr>
                <td>website</td>
                <td><input type="text" name="website" value="<?php echo $website;?>"></td>
            </tr>

            <tr>
                <td>address</td>
                <td><textarea rows="5" name="address"><?php echo htmlspecialchars($address);?></textarea></td>
            </tr>
            <tr>
                <td>Gender</td>
                <td>
                    <input type="radio" name="gender" value="Male" <?php if($gender=='male'){?>checked="checked"<?php }?>>Male
                     <input type="radio" name="gender" value="Female" <?php if($gender=='female'){?>checked="checked"<?php }?>>Female
                    <input type="radio" name="gender" value="Other" <?php if($gender=='other'){?>checked="checked"<?php }?>>Other

                </td>

            </tr>

            <tr>
                <td><input type="hidden" name="id" value=<?php echo $_GET['edit'];?>></td>

                <td>
                    <input type="submit" name="update" class="btn btn-primary" value="update">
                </td>
            </tr>
        </table>
    </form>
</body>
</html>