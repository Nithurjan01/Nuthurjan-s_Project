<?php
session_start();
if (isset($_SESSION['userId'])) {
    header('Location: protected-home.php');
    exit();
}
?>
<?php include 'header.php'; ?>
<style>
    main {
    padding: 100px;
    text-align: left;
}
</style>
<main>
    <center><h2>Login</h2></center>
    <form action="login_process.php" method="post">
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
        <label for="remember_me">
            <input type="checkbox" id="remember_me" name="remember_me">
            Remember Me
        </label>
        <center><button type="submit">Login</button></center>
    </form>
</main>
<?php include 'footer.php'; ?>
