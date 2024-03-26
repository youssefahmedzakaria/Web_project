<?php
$hostName = "localhost";
$DBusername = "root";
$DBpassword = "";
$DBname = "login_register";

$conn = mysqli_connect($hostName, $DBusername, $DBpassword, $DBname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

function register($fullname, $username, $dob, $phone, $address, $passwordHash, $image, $email) {
    global $conn;
    $sql = "INSERT INTO users (fullname, username, DOB, phone, address, password, image, email) VALUES ('$fullname', '$username', '$dob', '$phone', '$address', '$passwordHash', '$image', '$email')";
    if (mysqli_query($conn, $sql)) {
        echo "<div class='alert alert-success'> Registration successful </div>";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}

function checkUsername($username) {
    global $conn;
    $sql = "SELECT * FROM users WHERE username = '$username'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        return true;
    } else {
        return false;
    }
}
function checkEmail($email) {
    global $conn;
    $sql = "SELECT * FROM users WHERE email = '$email'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        return true;
    } else {
        return false;
    }
}
function checkPhone($phone) {
    global $conn;
    $sql = "SELECT * FROM users WHERE phone = '$phone'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        return true;
    } else {
        return false;
    }
} 

function login($username, $password) {
    global $conn;
    $sql = "SELECT * FROM users WHERE username = '$username'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        if (password_verify($password, $row['password'])) {
            $_SESSION['username'] = $username;
            header("Location: index.php");
        } else {
            echo "<div class='alert alert-danger'> Invalid password </div>";
        }
    } else {
        echo "<div class='alert alert-danger'> Invalid username </div>";
    }
}
?>