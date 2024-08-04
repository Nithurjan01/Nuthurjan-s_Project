<?php
session_start();
require 'conn.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    try {
        $stmt = $pdo->prepare('SELECT userId, password FROM tbl_users WHERE email = :email');
        $stmt->execute(['email' => $email]);
        $user = $stmt->fetch();

        if ($user && $user['password'] === $password) {
            $_SESSION['userId'] = $user['userId'];
            header('Location: protected-home.php');
            exit();
        } else {
            echo 'Invalid login credentials.';
        }
    } catch (PDOException $e) {
        echo 'Login failed: ' . $e->getMessage();
    }
}
?>
