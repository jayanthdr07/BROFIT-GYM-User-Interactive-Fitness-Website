<?php
// Database connection
$conn = new mysqli("localhost", "root", "", "brofit_gym");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $first_name = $_POST['first_name'];
    $last_name  = $_POST['last_name'];
    $email      = $_POST['email'];
    $password   = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $plan       = $_POST['membership_plan'];
    $training   = $_POST['training_mode'];
    $address    = $_POST['address'];
    $mobile     = $_POST['mobile'];

    $sql = "INSERT INTO registrations 
            (first_name, last_name, email, password, membership_plan, training_mode, address, mobile)
            VALUES (?,?,?,?,?,?,?,?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssssss",
        $first_name,
        $last_name,
        $email,
        $password,
        $plan,
        $training,
        $address,
        $mobile
    );

    if ($stmt->execute()) {
        echo "<script>alert('Registration Successful!');</script>";
    } else {
        echo "<script>alert('Error! Try again');</script>";
    }

    $stmt->close();
}
$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>BROFIT GYM Registration</title>
    <style>
        body {
            background: url('https://www.garagegymreviews.com/wp-content/uploads/2024/05/bodybuilding-poses-cover.jpg?auto=format&w=1350&q=80') no-repeat center center fixed; 
            background-size: cover;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
        }
        .registration-container {
            background-color: rgba(0, 0, 0, 0.75);
            padding: 40px 50px;
            border-radius: 10px;
            max-width: 400px;
            width: 90%;
            color: #ecf0f1;
        }
        h2 {
            color: #1abc9c;
            text-align: center;
        }
        input, textarea, select {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 5px;
        }
        button {
            width: 100%;
            padding: 12px;
            background: #1abc9c;
            color: white;
            border: none;
            font-size: 1.1em;
        }
    </style>
</head>

<body>
<div class="registration-container">
<h2>REGISTRATION FORM</h2>

<form method="POST">
    <input type="text" name="first_name" placeholder="First Name" required>
    <input type="text" name="last_name" placeholder="Last Name" required>
    <input type="text" name="email" placeholder="Email" required>
    <input type="text" name="password" placeholder="Password" required>

    <select name="membership_plan" required>
        <option value="">Select Plan</option>
        <option value="Basic">Basic</option>
        <option value="Monthly">Monthly</option>
        <option value="Yearly">Yearly</option>
    </select>

    <select name="training_mode" required>
        <option value="">Training Mode</option>
        <option value="Personal">Personal Training</option>
        <option value="Group">Group Training</option>
    </select>

    <textarea name="address" placeholder="Address" required></textarea>
    <input type="text" name="mobile" placeholder="Mobile No" required>

    <button type="submit">SUBMIT</button>
</form>
</div>
</body>
</html>
