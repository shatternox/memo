<?php
    require "../config/db.php";

    if(isset($_POST['username']) && isset($_POST['password'])){
        $username = $_POST['username'];
        $password = $_POST['password'];
        
        if(empty($username) || empty($password)) {
            die("Empty fields!");
        } else {
            
            $hashed = password_hash($password, PASSWORD_BCRYPT);
            $q = "SELECT * FROM users WHERE username = ?";

            $stmt = $conn->prepare($q);
            $stmt->bind_param("s", $username);
            $stmt->execute();

            $result = $stmt->get_result();

            if($result->num_rows > 0){
                die("Username taken!");
            } else {
                $q = "INSERT INTO users (username, password) VALUES (?,?)";

                $stmt = $conn->prepare($q);
                $stmt->bind_param("ss", $username, $hashed);
                $stmt->execute();
    
    
                header("Location: ../index.php");
            }    
        }
    } else {
        header("Location: ../register.php");
    }
