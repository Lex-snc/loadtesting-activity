<?php
include('db.php');

// Initialize variables
$row = array();
$error = '';
$success = '';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update'])) {
    // Get updated form data
    $id = mysqli_real_escape_string($conn, $_POST['id']);
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $gender = mysqli_real_escape_string($conn, $_POST['gender']);
    $hobby = mysqli_real_escape_string($conn, $_POST['hobby']);

    // Update query with prepared statement
    $sql = "UPDATE regform SET name=?, email=?, gender=?, hobby=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssi", $name, $email, $gender, $hobby, $id);
    
    if ($stmt->execute()) {
        $success = "Record updated successfully.";
    } else {
        $error = "Error: " . $stmt->error;
    }
    $stmt->close();
}

// Fetch current record data
if (isset($_GET['id'])) {
    $id = mysqli_real_escape_string($conn, $_GET['id']);
    $sql = "SELECT * FROM regform WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        $error = "Record not found.";
    }
    $stmt->close();
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
    <link rel="stylesheet" type="text/css" href="css/regform.css">
</head>
<body>
    <div class="container">
        <h2 style="text-align: center; color: #333; font-size: 1.8rem;">Edit User</h2>

        <?php if (!empty($error)): ?>
            <p class="error"><?php echo htmlspecialchars($error); ?></p>
        <?php endif; ?>

        <?php if (!empty($success)): ?>
            <p class="success"><?php echo htmlspecialchars($success); ?></p>
        <?php endif; ?>

        <?php if (!empty($row)): ?>
            <form action="edit.php" method="post">
                <input type="hidden" name="id" value="<?php echo htmlspecialchars($row['id']); ?>" />

                <div>
                    <label for="name">Name</label>
                    <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($row['name']); ?>" required />
                </div>

                <div>
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($row['email']); ?>" required />
                </div>

                <div>
                    <label>Gender</label>
                    <label><input type="radio" name="gender" value="female" <?php echo $row['gender'] == 'female' ? 'checked' : ''; ?>> Female</label>
                    <label><input type="radio" name="gender" value="male" <?php echo $row['gender'] == 'male' ? 'checked' : ''; ?>> Male</label>
                </div>

                <div>
                    <label for="hobby">Hobby</label>
                    <select id="hobby" name="hobby" required>
                        <option value="Kaon" <?php echo $row['hobby'] == 'Kaon' ? 'selected' : ''; ?>>Kaon</option>
                        <option value="Tulog" <?php echo $row['hobby'] == 'Tulog' ? 'selected' : ''; ?>>Tulog</option>
                        <option value="Laag" <?php echo $row['hobby'] == 'Laag' ? 'selected' : ''; ?>>Laag</option>
                    </select>
                </div>

                <input type="submit" name="update" value="Update" />
            </form>
        <?php else: ?>
            <p>No record to edit.</p>
        <?php endif; ?>

        <p><a href="view.php">View All Records</a></p>
    </div>
</body>
</html>

<?php
$conn->close();
?>
