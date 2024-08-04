<?php
session_start();
if (!isset($_SESSION['userId'])) {
    header('Location: login.php');
    exit();
}
?>
<?php include 'header.php'; ?>
<style>

main {
    padding: 40px 20px;
    text-align: center;
}

h2 {
    margin-top: 0;
    color: #2c3e50; 
}

ul {
    list-style-type: none; 
    padding: 0;
}

ul li {
    margin: 10px 0; 
}

ul li a {
    text-decoration: none;
    color: #2c3e50;
    font-size: 18px;
}

ul li a:hover {
    text-decoration: underline;
    color: #2c3e50; 
}

</style>
<main>
    <h2>Welcome, User!</h2>
    <ul>
        <li><a href="profile.php">Update Profile</a></li>
        <li><a href="account.php">Change Password</a></li>
        <li><a href="holiday.php">View Public Holidays</a></li>
        <li><a href="logout.php">Logout</a></li>
    </ul>
</main>
<?php include 'footer.php'; ?>
