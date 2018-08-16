<?php
require_once "core/init.php";

if( !Session::exists('username') ) {
	Session::flash('login', 'anda harus login');
	Redirect::to('login');
}

if( Session::exists('profile') ) {
	echo Session::flash('profile');
}

require_once "templates/header.php";
?>


<h1>hi <?php echo Session::get('username') ?></h1>

<?php if( $user->is_admin( Session::get('username') ) ) { ?>
	Fungsi Khusus Admin
<?php } ?>


<?php require_once "templates/footer.php"; ?>