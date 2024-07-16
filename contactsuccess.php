<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Success</title>
    <link rel="stylesheet" href="styles.css"> <!-- Link to CSS file -->
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #1f1f1f;
            color: #fff;
            text-align: center;
        }

        h2 {
            color: #fff;
            border-bottom: 2px solid #fff;
            padding-bottom: 10px;
            font-style: italic;
            font-weight: bold;
        }

        h3 {
            color: #009688;
            margin-top: 20px;
            font-style: italic;
        }

        p {
            margin: 10px 0;
        }

        strong {
            color: #fff;
        }

        .btn {
            display: inline-block;
            padding: 10px 20px;
            background-color: #009688;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 20px;
        }

        .btn:hover {
            background-color: #00796b;
        }
    </style>
</head>
<body>
    <?php include('include/header.php'); ?>
    <h2>Contact Us</h2>
    
    <?php
    $servername = "localhost";
    $username = "root"; 
    $password = ""; 
    $dbname = "mummumrecipe";     

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Get form data
    $name = $_POST["name"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $enquiry = $_POST["enquiry"];
    $subject = $_POST["subject"];
    $posted_time = date('Y-m-d H:i:s');

    // Insert data into database
    $stmt = $conn->prepare("INSERT INTO contact (name, email, phone, enquiry, subject, posted_time) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssss", $name, $email, $phone, $enquiry, $subject, $posted_time);
    
    if ($stmt->execute()) {
        echo "<h3>Thank you for contacting us!</h3>";
        echo "<p>You have submitted the following information:</p>";
        echo "<p><strong>Name:</strong><br> " . $name . "</p>";
        echo "<p><strong>Email:</strong><br> " . $email . "</p>";
        echo "<p><strong>Phone:</strong><br> " . $phone . "</p>";
        echo "<p><strong>Type of Enquiry:</strong><br> " . $enquiry . "</p>";
        echo "<p><strong>Subject:</strong><br> " . $subject . "</p>";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the prepared statement and the database connection
    $stmt->close();
    $conn->close();
    ?>

    <!-- Back to Home button -->
    <a href="index.php" class="btn">Back to Home</a>

    <?php include('include/footer.php'); ?>
</body>
</html>
