<?php

$sql = "
SELECT * FROM genre;
";
$genre = execsql($conn, $sql)->fetchAll();
