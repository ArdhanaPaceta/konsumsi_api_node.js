<?php
// URL of the API
$url = 'https://jsonplaceholder.typicode.com/comments';

// Fetch data from the API
$response = file_get_contents($url);

// Convert JSON data to an array
$data = json_decode($response, true);


// Filter logic
// $filterId = isset($_GET['id']) ? $_GET['id'] : ''; // Filter by ID
// $filtername = isset($_GET['name']) ? $_GET['name'] : ''; // Filter by Title

// // Apply filters if any
// if ($filterId || $filtername) {
//     $data = array_filter($data, function ($comments) use ($filterId, $filtername) {
//         // Check if the ID matches the filter
//         $idMatch = !$filterId || strpos((string)$comments['id'], (string)$filterId) !== false;
        
//         // Check if the title matches the filter
//         $nameMatch = !$filtername || stripos($comments['name'], $filtername) !== false;
        
//         return $idMatch && $nameMatch;
//     });
// }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Post</title>
    <link rel="stylesheet" href="stlye.css">
</head>
<body>
    <h1>Data COMMENTS from JSONPlaceholder API (PHP)</h1>

    
    
    
    <!-- <form method="GET">
        <label for="id">Filter by ID:</label>
        <input type="text" name="id" id="id" value="<?php echo htmlspecialchars($filterId); ?>"> 

        <label for="title">Filter by Name:</label>
        <input type="text" name="name" id="name" value="<?php echo htmlspecialchars($filtername); ?>">

        <button type="submit">Filter</button>
        <a href="/">Reset</a>  Link to reset filters 
    </form> -->

    <table>
        <thead> <!-- Changed 'thread' to 'thead' -->
            <tr>
                <th>Id</th>
                <th>Name</th>
                <th>Email</th>
                <th>Body</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($data as $comments): ?> <!-- Added ':' after the foreach loop -->
                <tr>
                    <td><?php echo $comments['id']; ?></td>
                    <td><?php echo htmlspecialchars ($comments['name']); ?></td>
                    <td><?php echo htmlspecialchars ($comments['email']); ?></td>
                    <td><?php echo htmlspecialchars ($comments['body']); ?></td>
                </tr>
            <?php endforeach; ?> <!-- Corrected closing tag for the foreach loop -->
        </tbody>
    </table>
</body>
</html>
