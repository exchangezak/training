<?php
$pdo=new PDO("mysql:host=localhost;dbname=datas;charset=utf8","root","");
$statement=$pdo->prepare($sql);
$statement->execute($tab);