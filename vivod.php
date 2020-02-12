<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body><pre>
<?php
require_once "connect.php";
$stmt = $pdo->prepare("SELECT books.id_book,books.name_book, GROUP_CONCAT( autors.name) as name,GROUP_CONCAT(autors.id_aut) as id_aut, prom.id_book,prom.id_aut FROM prom INNER JOIN books INNER JOIN autors ON prom.id_book=books.id_book AND prom.id_aut=autors.id_aut GROUP BY books.id_book ORDER BY books.id_book ");
$stmt->execute();
$stmt = $stmt->fetchAll(PDO::FETCH_ASSOC);
var_dump($stmt);
$a=[];
$select_sql = $pdo->prepare("SELECT `id_aut`, `id_book` FROM `prom` ");
$select_sql->execute();
$select_sql = $select_sql->fetchAll(PDO::FETCH_ASSOC);

for ($i = 0; $i < count($stmt); $i++) {
    echo "<table>
<tr> <th>Название:</th> <th>Ф.И.О:</th> </tr>
 <tr> <td>" . $stmt[$i]['name_book'] . "</th></td>  <td>" . $stmt[$i]['name'] . " </td> </tr>
</table>";
}
?></pre>
</body>
</html>
<?php
