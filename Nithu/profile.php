<?php
session_start();
if (!isset($_SESSION['userId'])) {
    header('Location: login.php');
    exit();
}
require 'conn.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $fullName = $_POST['fullName'];
    $city = $_POST['city'];

    try {
        $stmt = $pdo->prepare('UPDATE tbl_users SET email = :email, fullName = :fullName, city = :city WHERE userId = :userId');
        $stmt->execute([
            'email' => $email,
            'fullName' => $fullName,
            'city' => $city,
            'userId' => $_SESSION['userId']
        ]);
        echo 'Profile updated successfully.';
    } catch (PDOException $e) {
        echo 'Profile update failed: ' . $e->getMessage();
    }
}

// Fetch user details
$stmt = $pdo->prepare('SELECT email, fullName, city FROM tbl_users WHERE userId = :userId');
$stmt->execute(['userId' => $_SESSION['userId']]);
$user = $stmt->fetch();
?>
<?php include 'header.php'; ?>
<main>
    <center><h2>Update Profile</h2></center>
    <form action="" method="post">
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required>
        <label for="fullName">Full Name:</label>
        <input type="text" id="fullName" name="fullName" value="<?php echo htmlspecialchars($user['fullName']); ?>" required>
        <label for="city">City:</label>
        <input type="text" id="city" name="city" value="<?php echo htmlspecialchars($user['city']); ?>" required>
        <center><button type="submit">Update Profile</button></center>
    </form>
</main>
<?php include 'footer.php'; ?>
