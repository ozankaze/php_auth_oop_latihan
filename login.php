<?php
require_once "core/init.php";

if( Session::exists('username') ) {
  Redirect::to('profile');
}

if( Session::exists('login') ) {
  echo Session::flash('login');
}

$errors = [];

if( Input::get('submit') ) {

  if( Token::check(Input::get('token')) ) {

	// 1. memanggil object validasi
	$validation = new Validation();

	// 2. metode check
	$validation = $validation->check(array(
		"username" => array( 'required' => true ),
		"password" => array( 'required' => true ),
	));  


  // 3. lolos pengujian  
	if( $validation->passed() ) { 
  
    if ( $user->cek_nama(Input::get('username')) ) {
      if( $user->login_user( Input::get('username'),Input::get('password') ) ) {
        Session::set('username', Input::get('username'));
        Redirect::to('profile');
      } else {
        $errors[] =  "login gagal";
      }
    } else {
        $errors[] =  "namanya belum terdaftar";
    }
  } else {
  	// die('ada masalah');
  	$errors[] = $validation->errors();
  }
 }
}

require_once "templates/header.php";
?>

<h1>Daftar di sini</h1><br>
<form action="login.php" method="post">

    <label>Username</label>
    <input type="text" name="username"><br><br>

    <label>Password</label>
    <input type="text" name="password"><br><br>

    <input type="hidden" name="token" value="<?php echo Token::generate() ?>">

    <input type="submit" name="submit" value="login sekarang">

  <?php if( !empty($errors) ) { ?>
  	<div>
  		<?php foreach ($errors as $error) : ?>
  			<li><?php echo $error ?></li>
  		<?php endforeach ?>
  	</div>
  <?php } ?>

</form>

<?php require_once "templates/footer.php"; ?>


