<?php
include('db.php');

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    // Retrieve form data
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $gender = mysqli_real_escape_string($conn, $_POST['gender']);
    $hobby = mysqli_real_escape_string($conn, $_POST['hobby']);

    // Validate email format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Invalid email format";
    } else {
        // Insert into database using prepared statement
        $sql = "INSERT INTO regform (name, email, gender, hobby) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssss", $name, $email, $gender, $hobby);
        
        if ($stmt->execute()) {
            $success = "New record created successfully.";
        } else {
            $error = "Error: " . $stmt->error;
        }
        $stmt->close();
    }
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
    <link rel="stylesheet" type="text/css" href="css/regform.css">
</head>
<body>
    <div class="container">
        <!-- Display success/error messages -->
        <?php if (isset($success)): ?>
            <div class="message success"><?php echo htmlspecialchars($success); ?></div>
        <?php endif; ?>

        <?php if (isset($error)): ?>
            <div class="message error"><?php echo htmlspecialchars($error); ?></div>
        <?php endif; ?>

        <h2 style="text-align: center; color: #333; font-size: 1.8rem;">Registration Form</h2>
        <form action="regform.php" method="post">
            <div>
                <label for="name">Name</label>
                <input type="text" id="name" name="name" required />
            </div>

            <div>
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required />
            </div>

            <div>
                <label>Gender</label>
                <label><input type="radio" name="gender" value="female" required> Female</label>
                <label><input type="radio" name="gender" value="male"> Male</label>
            </div>

            <div>
                <label for="hobby">Hobby</label>
                <select id="hobby" name="hobby" required>
                    <option value="Kaon">Kaon</option>
                    <option value="Tulog">Tulog</option>
                    <option value="Laag">Laag</option>
                </select>
            </div>

            <input type="submit" name="submit" value="Submit" />
        </form>

        <p><a href="view.php">View All Records</a></p>
    </div>
</body>
</html>

<?php
$conn->close();
?>
