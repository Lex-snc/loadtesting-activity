<?php

// 1st function: Generate random numbers and return them in an array
function generateRandomNumbers($count) {
    $randomNumbers = [];
    for ($i = 0; $i < $count; $i++) {
        $randomNumbers[] = rand(1, 100); 
    }
    return $randomNumbers;
}

// 2nd function: Store the generated numbers into the array
function storeNumbers($numbers) {
    return $numbers; 
}

// 3rd function: Sort the array in ascending order and display the sorted numbers
function sortAndDisplayNumbers($numbers) {
    sort($numbers); // Sort the numbers array in ascending order
    echo "<h3>Sorted Numbers (Ascending): </h3>";
    echo "<p>" . implode(", ", $numbers) . "</p>"; 
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Random Numbers Generator</title>
</head>
<body>
    <h1>Random Numbers Generator</h1>
    
    <?php
    // Generate 10 random numbers
    $randomNumbers = generateRandomNumbers(10);

    // Display generated random numbers
    echo "<h3>Generated Random Numbers: </h3>";
    echo "<p>" . implode(", ", $randomNumbers) . "</p>";
    echo "<hr>"; 

    // Store those numbers
    $storedNumbers = storeNumbers($randomNumbers);

    // Sort and display the sorted numbers
    sortAndDisplayNumbers($storedNumbers);
    ?>

    <hr>

</body>
</html>
