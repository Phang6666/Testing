<!DOCTYPE html>
<head>
    <link rel="stylesheet" href="account_style.css">
</head>
<body>
<?php
// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Connect to the database
    $conn = mysqli_connect('localhost', 'root', '', 'mummumrecipe');

    // Check if the connection was successful
    if(!$conn) {
        die ('Connection failed: ' . mysqli_connect_error());
    }

    // Prepare the SQL query
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $hashed_password = md5($password);

    // Check if the email already exists
    $check_query = "SELECT * FROM user WHERE email = '$email'";
    $result = mysqli_query($conn, $check_query);
    if(mysqli_num_rows($result) > 0) {
        echo '<script>alert("This email address is already registered. Please use a different email address.");</script>';
    } else {
        // Insert new record
        $query = "INSERT INTO user (email, password) VALUES ('$email', '$hashed_password')";
        
        // Execute the query
        if (mysqli_query($conn, $query)) {
            echo '<script>alert("Account created successfully!");</script>';
            echo '<meta http-equiv="refresh" content="0.5;url=login.php">'; // Redirect after 0.5 seconds
            exit;
        } else {
            echo 'Error creating account: ' . mysqli_error($conn);
        }
    }

    // Close the database connection
    mysqli_close($conn);
}
?>




    <form method="POST">
        <a class="back-btn" href='index.php'>&lt; Back</a>
        <div id="title">
        <label>Create Account</label>
        </div>
        <label for="email">Email:<label>
        <input type="email" name="email" required><br>
        <label for="password">Password:</label>
        <input type="password" name="password" required><br>
        <input type="submit" value="Create Account">
    </form>
    <br>
    <a href="login.php">Already have an account? Click here to login</a>
</body>
</html>