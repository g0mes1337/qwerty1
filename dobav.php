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
<?php
require_once "connect.php";
$stmt = $pdo->query('SELECT books.name_book,autors.name  FROM books INNER JOIN autors ON books.id_book = prom.id_book AND autors.id_aut= prom.id_aut;');
while ($data = $stmt->fetch()) {
    echo "<table>
<tr> <th>Название:</th> <th>Ф.И.О:</th> <th>".$data['id_aut']." </th> <td>".$data['id_book']."</td> </tr>
 <tr> <td>" . $data['name_book'] . "</th></td>  <td>" . $data['aut'] . " </td> </tr>
</table>";
}
?>
<br>
</body>
</html>

?>
<form action="dobav.php" method="post">
    <input type="text" name="name" placeholder="автор">
    <input type="text" name="book" placeholder="книга">
    <input type="submit">
</form>
<?php
require_once "connect.php";
$name_book = $_POST['book'];
$name_aut = $_POST['name'];
if (!empty($_POST['book']) && !empty($_POST['name'])) {
    $stmt = $pdo->prepare("INSERT INTO books(name_book) VALUES(:name_book)");
    $stmt->bindParam(':name_book',$name_book,PDO::PARAM_STR);
    $stmt->execute();
    $stmt1 = $pdo->prepare("INSERT INTO aut(name) VALUES(:name_aut)");
    $stmt1->bindParam(':name_aut',$name_aut,PDO::PARAM_STR);
    $stmt1->execute();
}
?>
</body>
</html>

