<?php 
require 'connection.php';

if(isset($_POST['submit'])){
    $id = $_POST['id'];
    $message = $_POST['message'];

    if(empty($message)){
        echo "<br><br><br><br><br><br><br>";
        echo "<h3><center>❌ Please fill in the message to proceed!</center></h3>";
    } else {
        // Update the message in the message table
        $sql = "UPDATE message SET description = '$message' WHERE msg_id = '$id'";

        if($conn->query($sql) === TRUE){
            echo "<br><br><br>";
            echo "<h2><center>✅ Message updated!</h2> <br><center>";
            header("Location:view_message.php");
            exit();
        } else {
            echo "<br><br><br><br><br><br><br>";
            echo "<h3><center>⚠️  Message update failed!</center></h3>";
        }
    }
}
?>
