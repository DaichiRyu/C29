<?php

// ログアウトしてログインページに遷移
session_start();
session_destroy();

header("Location: ../login.html");
exit();
