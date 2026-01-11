<?php
// Database connection
$conn = new mysqli("localhost", "root", "", "brofit_gym");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $height   = $_POST['height'];
    $weight   = $_POST['weight'];
    $age      = $_POST['age'];
    $gender   = $_POST['gender'];
    $goal     = $_POST['goal'];
    $bodyfat  = $_POST['bodyfat'];
    $activity = $_POST['activity'];

    $sql = "INSERT INTO fitness_profiles 
            (height, weight, age, gender, goal, bodyfat, activity)
            VALUES (?,?,?,?,?,?,?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param(
        "idissis",
        $height,
        $weight,
        $age,
        $gender,
        $goal,
        $bodyfat,
        $activity
    );

    if ($stmt->execute()) {
        echo "<script>alert('Fitness profile saved successfully!');</script>";
    } else {
        echo "<script>alert('Error saving profile');</script>";
    }

    $stmt->close();
}
$conn->close();
?>
<!DOCTYPE html>
<html>
<head>
    <title>User Fitness Profile</title>
    <style>
        body {
            background: url('https://images.peopleimages.com/picture/202309/2931363-gym-group-and-dumbbell-rowing-exercise-for-power-muscle-and-challenge-in-workout-class.-diversity-of-strong-people-bodybuilding-and-push-up-with-weights-for-fitness-healthy-training-and-action-fit_400_400.jpg?auto=format&fit=crop&w=1350&q=80') no-repeat center/cover; 
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #ecf0f1;
            padding: 20px;
            margin: 0;
            display: flex;
            justify-content: center;
        }

        .profile-container {
            background-color: rgba(44, 62, 80, 0.9);
            padding: 40px;
            border-radius: 10px;
            max-width: 600px;
            width: 100%;
            margin: 20px 0;
            box-shadow: 0 0 25px rgba(0, 0, 0, 0.5);
        }

        h2 {
            color: #f1c40f;
            text-align: center;
            margin-bottom: 30px;
            text-transform: uppercase;
            border-bottom: 2px solid #f1c40f;
            padding-bottom: 10px;
            font-size: 1.8em;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
            color: #bdc3c7;
        }

        .form-group input, .form-group select {
            width: 100%;
            padding: 10px;
            border: 1px solid #1abc9c;
            border-radius: 5px;
            background-color: #34495e;
            color: #ecf0f1;
        }

        button[type="submit"] {
            width: 100%;
            background-color: #1abc9c;
            color: white;
            padding: 15px;
            margin-top: 20px;
            border: none;
            border-radius: 5px;
            font-size: 1.1em;
            font-weight: bold;
        }
    </style>
</head>

<body>
<div class="profile-container">
<h2>Personal Fitness Profile</h2>

<form method="POST">

    <h3>Personal Details</h3>
    <div class="form-group">
        <label>Height (cm):</label>
        <input type="number" name="height" required>
    </div>

    <div class="form-group">
        <label>Current Weight (kg):</label>
        <input type="number" step="0.1" name="weight" required>
    </div>

    <div class="form-group">
        <label>Age:</label>
        <input type="number" name="age" required>
    </div>

    <div class="form-group">
        <label>Gender:</label>
        <select name="gender" required>
            <option value="" disabled selected>Select Gender</option>
            <option value="male">Male</option>
            <option value="female">Female</option>
            <option value="other">Other</option>
        </select>
    </div>

    <hr style="border-color:#34495e">

    <h3>Fitness Goals & History</h3>

    <div class="form-group">
        <label>Primary Goal:</label>
        <select name="goal" required>
            <option value="" disabled selected>Select Primary Goal</option>
            <option value="weight_loss">Weight Loss</option>
            <option value="muscle_gain">Muscle Gain</option>
            <option value="endurance">Endurance</option>
            <option value="maintain">Maintenance</option>
        </select>
    </div>

    <div class="form-group">
        <label>Estimated Body Fat %:</label>
        <input type="number" name="bodyfat">
    </div>

    <div class="form-group">
        <label>Weekly Activity Level:</label>
        <select name="activity" required>
            <option value="" disabled selected>Select Activity Level</option>
            <option value="sedentary">Sedentary</option>
            <option value="light">Light</option>
            <option value="moderate">Moderate</option>
            <option value="very">Very Active</option>
        </select>
    </div>

    <button type="submit">Update My Bio Record</button>
</form>
</div>
</body>
</html>
