<?php
// URL of the API
$url = 'https://jsonplaceholder.typicode.com/posts';

// Fetch data from the API
$response = file_get_contents($url);

// Convert JSON data to an array
$data = json_decode($response, true);

// Filter logic
$filterId = isset($_GET['id']) ? $_GET['id'] : ''; // Filter by ID
$filterTitle = isset($_GET['title']) ? $_GET['title'] : ''; // Filter by Title

// Apply filters if any
if ($filterId || $filterTitle) {
    $data = array_filter($data, function ($post) use ($filterId, $filterTitle) {
        // Check if the ID matches the filter
        $idMatch = !$filterId || strpos((string)$post['id'], (string)$filterId) !== false;
        
        // Check if the title matches the filter
        $titleMatch = !$filterTitle || stripos($post['title'], $filterTitle) !== false;
        
        return $idMatch && $titleMatch;
    });
}
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
    <h1>Data Posts from JSONPlaceholder API (PHP)</h1>

    <!-- Filter Form -->
    <form method="GET">
        <label for="id">Filter by ID:</label>
        <input type="text" name="id" id="id" value="<?php echo htmlspecialchars($filterId); ?>">

        <label for="title">Filter by Title:</label>
        <input type="text" name="title" id="title" value="<?php echo htmlspecialchars($filterTitle); ?>">

        <button type="submit">Filter</button>
        <a href="/">Reset</a>  
    </form>

    <table>
        <thead>
            <tr>
                <th>Id</th>
                <th>Title</th>
                <th>Body</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($data)): ?>
                <?php foreach ($data as $post): ?>
                    <tr>
                        <td><?php echo $post['id']; ?></td>
                        <td><?php echo htmlspecialchars($post['title']); ?></td>
                        <td><?php echo htmlspecialchars($post['body']); ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="3">No posts found.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</body>
</html>
