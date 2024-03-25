<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>Register</title>
</head>

<body>
    <?php include 'header.php';?>
    <div class="container">
        <form action = "registration.php" method = "post">
            <?php 
            if (isset($_POST['submit'])) {
                $fullname = $_POST['fullname'];
                $username = $_POST['username'];
                $dob = $_POST['dob'];
                $phone = $_POST['phone'];
                $address = $_POST['address'];
                $password = $_POST['password'];
                $cpassword = $_POST['cpassword'];
                $image = $_POST['image'];
                $email = $_POST['email'];
                $passwordHash = password_hash($password, PASSWORD_DEFAULT);


                $errors = array();
                if (empty($fullname) or empty($username) or empty($dob) or
                 empty($phone) or empty($address) or empty($password) or 
                 empty($cpassword) or empty($image) or empty($email)){
                    array_push($errors, "All fields are required");
                }

                if ($password != $cpassword){
                    array_push($errors, "Password do not match");
                }

                if(strlen($password) < 8){
                    array_push($errors, "Password must be at least 6 characters");
                }

                if (!preg_match("/[0-9]/", $password)) {
                    array_push($errors, "Password must contain at least one number");
                }

                if (!preg_match("/[^a-zA-Z0-9]/", $password)) {
                    array_push($errors, "Password must contain at least one special character");
                }

                if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                    array_push($errors, "Email is invalid");
                }
                require_once "DB_Ops.php";
                if (count($errors) >0){
                    foreach($errors as $error){
                        echo "<div class = 'alert alert-danger'> $error </div>";
                    }
                }
                else if(checkUsername($username)){
                    echo "<div class = 'alert alert-danger'> Username already exists </div>";
                }
                else if(checkEmail($email)){
                    echo "<div class = 'alert alert-danger'> Email already exists </div>";
                }
                else if(checkPhone($phone)){
                    echo "<div class = 'alert alert-danger'> Phone number already exists </div>";
                }
                else{
                    require_once "DB_Ops.php";
                    register($fullname, $username, $dob, $phone, $address, $passwordHash, $image, $email);
                    header("Location: index.php");
                }
            }

            ?>
            <div class="form-group">
                <!-- full name  -->
               <input type="text" class = "form-control" name="fullname" placeholder = "Full name">
            </div>
            <div class="form-group">
                <!-- user name  -->
               <input type="text"class = "form-control" name="username" placeholder = "username">
            </div>
            <div class="form-group">
                <!-- date of birth  -->
               <input type= "date"class = "form-control" name="dob" placeholder = "Date of Birth">
            </div>
            <div class="form-group">
                <!-- phone  -->
               <input type= "tel" class = "form-control"name="phone" placeholder = "Phone">
            </div>
            <div class="form-group">
                <!-- address  -->
               <input type= "text"class = "form-control" name="address" placeholder = "Address">
            </div>
            <div class="form-group">
                <!-- password  -->
               <input type= "password" class = "form-control"name="password" placeholder = "Password">
            </div>
            <div class="form-group">
                <!-- confirm password  -->
               <input type= "password" class = "form-control"name="cpassword" placeholder = "Confirm Password">
            </div>
            <div class="form-group">
                <!-- user Image  -->
                <input type= "file" class = "form-control"name="image" placeholder = "Image">
            </div>
            <div class="form-group">
                <!-- email  -->
                <input type= "email" class = "form-control"name="email" placeholder = "Email">
            </div>
            <div class="form-btn" style = "text-align: center;">
                <button type="submit" class ="btn btn-primary"  name="submit">Submit</button>
            </div>

            <?php include 'footer.php';?>
</body>
</html>