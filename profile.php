<?php
require_once "core/init.php";

if( !Session::exists('username') ) {
	Session::flash('login', 'anda harus login');
	header("Location: login.php");
}

if( Session::exists('profile') ) {
	echo Session::flash('profile');
}

require_once "templates/header.php";
?>


<h1>hi <?php echo Session::get('username') ?></h1>


<?php require_once "templates/footer.php"; ?>