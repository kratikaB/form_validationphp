  <?php
  
        // servername => localhost
        // username => root
        // password => empty
        // database name => crezteddb
        $conn = mysqli_connect("localhost", "root", "1234", "createdb");
          
        // Check connection
        if($conn === false){
            die("ERROR: Could not connect. " 
                . mysqli_connect_error());
        }
          
        // Taking all 5 values from the form data(input)
        $name =  $_REQUEST['name'];
        $email = $_REQUEST['email'];
        $password = $_REQUEST['password'];
        $cpassword =  $_REQUEST['cpassword'];
        $website = $_REQUEST['website'];
        $comment = $_REQUEST['comment'];
        $gender = $_REQUEST['gender'];

          
        // Performing insert query execution
        // here our table name is college
        $sql = "INSERT INTO form_data  VALUES ('$name', 
            ' $email','$password','$cpassword','$website','$comment','$gender')";
          
        if(mysqli_query($conn, $sql)){
            echo "<h3>data stored in a database successfully." 
                . " Please browse your localhost php my admin" 
                . " to view the updated data</h3>"; 
  
            echo nl2br("\n$name\n $email\n$password\n$cpassword\n"
                . "\n$website\n$comment\n$gender\n");
        } else{
            echo "ERROR: Hush! Sorry $sql. " 
                . mysqli_error($conn);
        }
          
        // Close connection
        mysqli_close($conn);
        ?>