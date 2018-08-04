<?php
require_once "core/init.php";

if( Input::get('submit') ) {
    
}

require_once "templates/header.php";
?>

<h1>Daftar di sini</h1><br>
<form action="register.php" method="post">

    <label>Username</label>
    <input type="text" name="username"><br><br>

    <label>Password</label>
    <input type="text" name="password"><br><br>

    <input type="submit" name="submit" value="daftar sekarang">

</form>

<?php require_once "templates/footer.php"; ?>


