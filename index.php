<?php
$host = '127.0.0.1';
$db   = 'netland';
$user = 'root';
$pass = '';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";

$pdo = new PDO($dsn, $user, $pass);

$stmt = $pdo->prepare("SELECT * FROM movies WHERE volgnummer = :id");
$film = $_GET['id'];
$stmt->bindParam(':id', $film);
$stmt->execute();

$film = $stmt->fetch(PDO::FETCH_OBJ);

function getTitle()
{
    global $film;
    return $film->title;
}

function getDuration()
{
    global $film;
    return $film->duur;
}

function getDatum()
{
    global $film;
    return $film->datum;
}

function getCountry()
{
    global $film;
    return $film->land;
}

function getDescription()
{
    global $film;
    return $film->omschrijving;
}

function getTrailerID()
{
    global $film;
    return $film->trailer_id;
}

?>
<h2><?php echo getTitle(); echo ' - ' . getDuration();?></h2>

<form method="post" action="films_update.php">
    <input type="hidden" name="id" value=<?php echo $film_id;?>>
    <label for="title">Titel</label>
    <input type="text" name="title" value=<?php echo "'" . getTitle() . "'"; ?>>
    <br></br>
    <label for="duur">Duur</label>
    <input type="duur" name="duur" value=<?php echo getDuration(); ?>>
    <br></br>
    <label for="datum_uitkomst">Datum van uitkomst</label>
    <input type="text" name="datum" value=<?php echo getDatum();?>>
    <br></br>
    <label for="land_uitkomst">Land van uitkomst</label>
    <input type="text" name="land" value=<?php echo getCountry();?>>
    <br></br>
    <label for="omschrijving">Omschrijving</label>
    <textarea name="omschrijving" cols="30" rows="10"><?php echo getDescription();?></textarea>
    <br></br>
    <label for="trailer_id">Trailer id</label>
    <input type="text" name="trailer_id" value=<?php echo getTrailerID();?>>
    <br></br>
    <input type="submit" value="save">
</form>