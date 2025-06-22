<?php
include 'connect.php';

if (isset($_POST['signUp'])) {
    $FullName = $_POST['Name'];
    $email = $_POST['email'];
    $Mobileno = $_POST['Mobileno'];
    $password = $_POST['password'];
    $confirmpassword = $_POST['confirmpassword'];
    $password = md5($password);

    $checkEmail = "SELECT * FROM users WHERE email='$email'";
    $result = $conn->query($checkEmail);

    if ($result->num_rows > 0) {
        echo "Email Address Already Exists!";
    } else {
        $insertQuery = "INSERT INTO users (FullName, email, Mobileno, password, confirmpassword)
                        VALUES ('$FullName', '$email', '$Mobileno', '$password', '$confirmpassword')";

        if ($conn->query($insertQuery) === TRUE) {
            header("location: index.php");
        } else {
            echo "Error: " . $conn->error;
        }
    }
}

if (isset($_POST['signIn'])) {
    $email = $_POST['email'];
    $password = md5($_POST['password']);

    $sql = "SELECT * FROM users WHERE email='$email' AND password='$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        session_start();
        $row = $result->fetch_assoc();
        $_SESSION['email'] = $row['email'];
        header("Location: homepage.php");
        exit();
    } else {
        echo "Not Found, Incorrect Email or Password";
    }
}
