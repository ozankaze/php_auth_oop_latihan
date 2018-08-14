<?php
require_once "core/init.php";

$errors = array();

if( Input::get('submit') ) {

	// 1. memanggil object validasi
	$validation = new Validation();

	// 2. metode check
	$validation = $validation->check(array(
		"username" => array(
								'required' => true,
								'min' => 3,
								'max' => 50, 
							),
		"password" => array(
								'required' => true,
								'min' => 3, 
							),
	));  


  // 3. lolos pengujian  
	if( $validation->passed() ) { 
  
    $user->register_user(array(
        'username' => Input::get('username'),
        'password' => password_hash(Input::get('password'), PASSWORD_DEFAULT)
    ));

    Session::set('username', Input::get('username'));
    header("Location: profile.php");

    // die($user);
  } else {
  	// die('ada masalah');
  	$errors = $validation->errors();
  }

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

  <?php if( !empty($errors) ) { ?>
  	<div>
  		<?php foreach ($errors as $error) : ?>
  			<li><?php echo $error ?></li>
  		<?php endforeach ?>
  	</div>
  <?php } ?>

</form>

<?php require_once "templates/footer.php"; ?>


