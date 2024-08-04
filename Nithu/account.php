<?php
session_start();
if (!isset($_SESSION['userId'])) {
    header('Location: login.php');
    exit();
}
require 'conn.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $oldPassword = $_POST['oldPassword'];
    $newPassword = $_POST['newPassword'];

    try {
        $stmt = $pdo->prepare('SELECT password FROM tbl_users WHERE userId = :userId');
        $stmt->execute(['userId' => $_SESSION['userId']]);
        $user = $stmt->fetch();

        if ($user && $oldPassword === $user['password']) {
            $stmt = $pdo->prepare('UPDATE tbl_users SET password = :password WHERE userId = :userId');
            $stmt->execute([
                'password' => $newPassword,
                'userId' => $_SESSION['userId']
            ]);
            echo 'Password updated successfully.';
        } else {
            echo 'Old password is incorrect.';
        }
    } catch (PDOException $e) {
        echo 'Password update failed: ' . $e->getMessage();
    }
}
?>
<?php include 'header.php'; ?>
<main>
    <center><h2>Change Password</h2></center>
    <form action="" method="post">
        <label for="oldPassword">Old Password:</label>
        <input type="password" id="oldPassword" name="oldPassword" required>
        <label for="newPassword">New Password:</label>
        <input type="password" id="newPassword" name="newPassword" required>
        <center><button type="submit">Change Password</button></center>
    </form>
</main>
<?php include 'footer.php'; ?>
