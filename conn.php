<?php
// Arquivo responsável por conectar a nossa base de dados
$hostname_conn = "127.0.0.1";
$database_conn = "mydb";
$username_conn = "root";
$password_conn = "";
    global $conn;
// Conectamos ao nosso servidor MySQL
        $conn = mysqli_connect("127.0.0.1","root","","mydb") or  die( "Erro ao conectar ao MySQL.");
