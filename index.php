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
} catch (\PDOExeption $e) {
    throw new \PDOExeption($e->getMessage("no connection"), (int)$e->getCode());
}
$moviedata = $pdo->query('SELECT * from movies');
?>

<html>

<head>
</head>

<body>
    <form method="post">
        <h1>Titel: </h1><br>
        <input type="text" name="titleUpload"><br>
        <h1>Duur: </h1><br>
        <input type="number" name="duurUpload"><br>
        <h1>Datum van uitkomst: </h1><br>
        <input type="text" name="datumUpload"><br>
        <h1>Land van uitkomst: </h1>
        <input type="text" name="landUpload"><br>
        <h1>Omschrijving: </h1>
        <input type="text" name="omschrijfUpload" size="50"><br>
        <input type="submit" name="upload">
    </form>
    <table>
    <?php
        if(isset($_POST["upload"])){
            $title = $_POST['titleUpload'];
            $duur = $_POST['duurUpload'];
            $datum = $_POST['datumUpload'];
            $land = $_POST['landUpload'];
            $omschrijf = $_POST['omschrijfUpload'];
            $moviedata = $pdo->query('SELECT * from movies');

            $query = "INSERT INTO `movies` (title, duur, datum_van_uitkomst, land_van_uitkomst, description) VALUES (:title, :duur, :datum, :land, :omschrijf)";

            $pdoresult = $pdo->prepare($query);

            $pdoExec = $pdoresult->execute(array(":title"=>$title,":duur"=>$duur,":datum"=>$datum,":land"=>$land,":omschrijf"=>$omschrijf));
            header("Location: ./index.php?link=".$_GET['link']."");
        } 

        foreach ($moviedata as $row){
    ?>
        <tr>
            <td>
                <form method="get">
                <input name="link" type="submit" value="<?php echo $row['id'] ?>">
                </form>
            </td>
            <td><?php echo "title: " .  $row['title']; ?></td>
            <td><?php echo "title: " .  $row['duur']; ?></td>
            <td><?php echo "title: " .  $row['datum']; ?></td>
            <td><?php echo "title: " .  $row['land']; ?></td>
            <td><?php echo "title: " .  $row['omschrijf']; ?></td>
        </tr>
    <?php
        }
    ?>
    </table>
</body>
</html>