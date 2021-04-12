<?php
  
        // servername => localhost
        // username => root
        // password => empty
        // database name => crezteddb
        $conn = mysqli_connect("localhost", "root", "1234", "createdb");
          // create function for generate random password
			function generate_password($len = 6){
			 $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
			 $password = substr( str_shuffle( $chars ), 0, $len );
			  $enc_pass = md5($password);
			 return $password;
			}

        // Check connection
        if($conn === false){
            die("ERROR: Could not connect. " 
                . mysqli_connect_error());
        }