<?php 
session_start();
require "../config/db.php";

    if(isset($_POST['title']) && isset($_POST['content']) && isset($_POST['insert'])){
        $title = $_POST['title'];
        $content = $_POST['content'];
        $user_id = $_SESSION['user_id'];
   
        $q = "INSERT INTO memos (title, content, user_id) VALUES (?,?,?)";

        $stmt = $conn->prepare($q);
        $stmt->bind_param("ssi", $title, $content, $user_id);
        $stmt->execute();
        
    }

    header("Location: ../memo.php")

?>