<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<form action="dobav.php" method="post">
    <input type="text" name="name" placeholder="автор">
    <input type="text" name="book" placeholder="книга">
    <input type="submit">
</form>
</body>
</html>
<?php
require_once "connect.php";
$name_book = $_POST['book'];
$name_aut = $_POST['name'];

$pdo_select = $pdo->prepare("SELECT id_aut,`name` FROM `autors` WHERE name='$name_aut'");
$pdo_select->execute();
$pdo_select = $pdo_select->fetchAll(PDO::FETCH_ASSOC);
$bk = $pdo_select[0]['name'];
$bk_id = $pdo_select[0]['id_aut'];

$pdo_select = $pdo->prepare("SELECT id_book,`name_book` FROM `books` WHERE name_book='$name_book'");
$pdo_select->execute();
$pdo_select = $pdo_select->fetchAll(PDO::FETCH_ASSOC);
$at = $pdo_select[0]['name_book'];
$at_id = $pdo_select[0]['id_book'];

if ($bk != null && $at != null) {
    $stmt = $pdo->prepare("INSERT INTO `prom` (`id_aut`, `id_book`) VALUES ('$bk_id', '$at_id')");
    $stmt->bindParam(':bk_id', $bk_id, PDO::PARAM_INT);
    $stmt->bindParam(':at_id', $at_id, PDO::PARAM_INT);
    $stmt->execute();

} elseif ($bk != null) {
    $stmt = $pdo->prepare("INSERT INTO books(name_book) VALUES(:name_book)");
    $stmt->bindParam(':name_book', $name_book, PDO::PARAM_STR);
    $stmt->execute();
    $book_id = $pdo->lastInsertId();
    $stmt = $pdo->prepare("INSERT INTO `prom` (`id_aut`, `id_book`) VALUES ('$bk_id', '$book_id')");
    $stmt->bindParam(':bk_id', $bk_id, PDO::PARAM_INT);
    $stmt->bindParam(':book_id', $book_id, PDO::PARAM_INT);
    $stmt->execute();

} elseif ($at != null) {
    $stmt = $pdo->prepare("INSERT INTO autors(name) VALUES(:name_aut)");
    $stmt->bindParam(':name_aut', $name_aut, PDO::PARAM_STR);
    $stmt->execute();
    $aut_id = $pdo->lastInsertId();
    $stmt = $pdo->prepare("INSERT INTO `prom` (`id_aut`, `id_book`) VALUES ('$aut_id', '$at_id')");
    $stmt->bindParam(':aut_id', $aut_id, PDO::PARAM_INT);
    $stmt->bindParam(':at_id', $at_id, PDO::PARAM_INT);
    $stmt->execute();

} elseif (!empty($_POST['book']) && !empty($_POST['name'])) {
    $stmt = $pdo->prepare("INSERT INTO books(name_book) VALUES(:name_book)");
    $stmt->bindParam(':name_book', $name_book, PDO::PARAM_STR);
    $stmt->execute();
    $book_id = $pdo->lastInsertId();
    $stmt1 = $pdo->prepare("INSERT INTO autors(name) VALUES(:name_aut)");
    $stmt1->bindParam(':name_aut', $name_aut, PDO::PARAM_STR);
    $stmt1->execute();
    $aut_id = $pdo->lastInsertId();
    $stmt = $pdo->prepare("INSERT INTO `prom` (`id_aut`, `id_book`) VALUES ('$aut_id', '$book_id')");
    $stmt->bindParam(':aut_id', $aut_id, PDO::PARAM_INT);
    $stmt->bindParam(':book_id', $book_id, PDO::PARAM_INT);
    $stmt->execute();

}
?>
