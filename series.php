<?php
$host = '127.0.0.1';
$db   = 'netland';
$user = 'root';
$pass = '';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];
try {
     $pdo = new PDO($dsn, $user, $pass, $options);
     
} catch (\PDOException $e) {
     throw new \PDOException($e->getMessage("no connection"), (int)$e->getCode());
}
$coachdata = $pdo->query('SELECT * from series where id ='. $_GET['link']);
?>
<html lang="nl">
<head>  
</head>
<body>
    <table>
        <?php
        foreach ($coachdata as $row){
            ?>
        <tr>
            <td><h1><?php echo $row['title']; ?></h1></td>
        </tr>
        <tr>
            <td><?php echo "rating: " .  $row['rating']; ?></td>
        </tr>
        <tr>
            <td><?php echo "land van herkomst: " .  $row['country']; ?></td>
        </tr>
        <tr>
            <td><?php echo "language: " .  $row['language']; ?></td>
        </tr>
        <tr>
            <td><?php echo "description: " . $row['description']; ?></td>
        </tr>
        <tr>
            <td><?php echo "awards: " . $row['has_won_awards']; ?></td>
        </tr>
        <?php
        }
        ?>
    </table>
</body>

</html>