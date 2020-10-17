<?php

/*
// PDO
$db = new PDO('mysql:host=localhost;dbname=project', 'table', 'secret');
$users = $db->query('SELECT * FROM users')->fetchAll(PDO::FETCH_OBJ);
echo json_encode($users);
*/

// API
if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
    http_response_code(405);
    //echo "Method not allowed";
    echo json_encode([
        'error' => "Method not allowed"
    ]);
    return;
}

if ($_SERVER['HTTP_ACCEPT'] == 'application/json') {
    http_response_code(200);
    header('Content-type: application/json');
    echo $users = file_get_contents(__DIR__ . '/users.json');
} elseif ($_SERVER['HTTP_ACCEPT'] == 'text/html') {
    $users = json_decode(file_get_contents(__DIR__ . '/users.json'));
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users</title>
</head>
<body>
    <ul>
    <?php foreach($users as $user) : ?>
    <li><?= $user->name ?> - <?= $user->email ?></li>
    <?php endforeach ?>
    </ul>
</body>
</html>
<?php
}
