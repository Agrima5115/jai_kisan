<?php
session_start();
include("db.php");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['signupButton'])) {
        // Process signup form
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];

        // Check for empty fields
        if (empty($name) || empty($email) || empty($password)) {
            echo "<script type='text/javascript'>alert('Please fill in all fields')</script>";
        } else {
            $query = "INSERT INTO users (name, email, password) VALUES ('$name', '$email', '$password')";
            mysqli_query($con, $query);

            // Redirect to form.html after successful signup
            header("Location: form.php");
            exit();
        }
    } elseif (isset($_POST['signIn'])) {
        // Process login form
        $loginEmail = $_POST['loginEmail'];
        $loginPassword = $_POST['loginPassword'];

        $query = "SELECT * FROM users WHERE email = '$loginEmail'";
        $result = mysqli_query($con, $query);

        if ($result && mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            if ($loginPassword == $row['password']) {
                // Set session variable for logged-in user
                $_SESSION['user_id'] = $row['id'];

                // Redirect to index.html after successful signin
                header("Location: index11.html");
                exit();
            } else {
                echo "<script type='text/javascript'>alert('Incorrect password')</script>";
            }
        } else {
            echo "<script type='text/javascript'>alert('User not found')</script>";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <title>Login</title>
  <link rel="stylesheet" href="Signup.css">
  <link href="https://fonts.googleapis.com/css?family=Arvo" rel="stylesheet">
	<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css'>
</head>
<body>
<div class="container" id="container">
	<div class="form-container sign-up-container">
		<form id="signupForm"  method="post">
			<h1>Create Account</h1>
			<input type="text" placeholder="Name" id="name" name="name" />
			<input type="email" placeholder="Email" id="email" name="email" />
			<input type="password" placeholder="Password" id="password" name="password" />
			<button type="submit" id="signupButton" name="signupButton">Sign Up</button>
		 </form>		 
	</div>
	<div class="form-container sign-in-container">
		<form method="post">
			<h1>Sign in</h1>
			<input type="email" placeholder="Email" name="loginEmail" />
			<input type="password" placeholder="Password" name="loginPassword" />
			<button type="submit" name="signIn">Sign In</button>
		 </form>
	</div>
	<div class="overlay-container">
		<div class="overlay">
			<div class="overlay-panel overlay-left">
				<h1>Welcome Back!</h1>
				<p>To keep connected with us please login with your personal details</p>
				<button class="ghost" id="signIn">Sign In</button>
			</div>
			<div class="overlay-panel overlay-right">
				<h1>Hi There!</h1>
				<p>Enter your personal details to open an account with us</p>
				<button class="ghost" id="signUp">Sign Up</button>
			</div>
		</div>
	</div>
</div>
<script src="Signup.js" charset="utf-8"></script>
</body>
</html>