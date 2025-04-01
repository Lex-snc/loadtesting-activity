
<!DOCTYPE html>
<html>
    <head>
        <title>Delete Record</title>
        <link rel="stylesheet" type="text/css" href="css/delete.css"> <!-- Link to your CSS file -->
    </head>
    <body>
        <div class="container">
            <?php
            include('db.php');

            if (isset($_GET['id'])) {
                $id = $_GET['id'];
                $sql = "DELETE FROM regform WHERE id=$id";

                if ($conn->query($sql) === TRUE) {
                    echo "<div class='message success'>Record deleted successfully.</div>";
                } else {
                    echo "<div class='message error'>Error: " . $sql . "<br>" . $conn->error . "</div>";
                }
            }

            $conn->close();
            ?>

            <p><a href="view.php">View All Records</a></p>
        </div>
    </body>
</html>
