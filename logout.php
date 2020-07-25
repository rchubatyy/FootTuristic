<?php
session_start();
include "conn.php";
$con = mysqli_connect($hostname_conn,$username_conn,$password_conn, $database_conn);
mysqli_query($con, "DELETE FROM carrinho WHERE sessao='".session_id()."' ");
session_destroy();
header("Location: index.php");
?>
