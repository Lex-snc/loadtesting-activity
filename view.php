<?php
include('db.php');

$sql = "SELECT * FROM regform";
$result = $conn->query($sql);
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Records</title>
    <link rel="stylesheet" type="text/css" href="css/view.css">
</head>
<body>
    <div class="container">
        <h2 style="text-align: center; color: #333; font-size: 1.8rem;">View All Records</h2>

        <div class="table-container">
            <?php if ($result->num_rows > 0): ?>
                <table>
                    <tr>
                        
                        <th>Name</th>
                        <th>Email</th>
                        <th>Gender</th>
                        <th>Hobby</th>
                        <th>Actions</th>
                    </tr>
                    <?php while($row = $result->fetch_assoc()): ?>
                        <tr>
                            
                            <td><?php echo htmlspecialchars($row["name"]); ?></td>
                            <td><?php echo htmlspecialchars($row["email"]); ?></td>
                            <td><?php echo htmlspecialchars($row["gender"]); ?></td>
                            <td><?php echo htmlspecialchars($row["hobby"]); ?></td>
                            <td>
                                <a href="edit.php?id=<?php echo $row["id"]; ?>">Edit</a> | 
                                <a href="delete.php?id=<?php echo $row["id"]; ?>">Delete</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </table>
            <?php else: ?>
                <p>No records found.</p>
            <?php endif; ?>
        </div>

        <p><a href="regform.php">Add New Record</a></p>
    </div>
</body>
</html>

<?php
$conn->close();
?>
