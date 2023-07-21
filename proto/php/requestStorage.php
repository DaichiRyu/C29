<?php

$sql = "
SELECT * FROM storage;
";
$storage = execsql($conn, $sql)->fetchAll();
