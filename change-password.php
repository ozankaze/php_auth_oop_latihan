<?php
	require_once "core/init.php";

	if( !$user->is_logIn() ) {
		Session::flash('login', 'anda harus login');
		Redirect::to('login');
	}

	$user_data = $user->get_data(Session::get('username'));

	$errors = [];

	if( Input::get('submit') ) {
	  if( Token::check(Input::get('token')) ) {

	  	// 1. memanggil object validasi
			$validation = new Validation();

			// 2. metode check
			$validation = $validation->check(array(
				"password" => array( 'required' => true ),
				"password_baru" => array(
								'required' => true,
								'min' => 3, 
							),
    		"password_verify" => array(
                'required' => true,
                'match' => 'password_baru',
              )
			));  

		  // 3. lolos pengujian  
			if( $validation->passed() ) { 

				if( password_verify(Input::get('password'), $user_data['password']) ) {

					$user->update_user(array(
		        'password' => password_hash(Input::get('password_baru'), PASSWORD_DEFAULT)
			    ), $user_data['id']);

			    Session::flash('profile', 'selamat anda menganti password');
					Redirect::to('profile');

				} else {
					$errors[] = 'password lama anda salah';
				}

			} else {
				$errors[] = $validation->errors();
			}
	  }
	}

	require_once "templates/header.php";
?>


<h1>hi <?php echo $user_data['username']  ?></h1>

<form action="change-password.php" action="post">
	<label>Password lama</label>
  <input type="text" name="password"><br><br>

  <label>Password baru</label>
  <input type="text" name="password_baru"><br><br>

  <label>Ulangi Password</label>
  <input type="text" name="password_verify"><br><br>

  <input type="hidden" name="token" value="<?php echo Token::generate() ?>">

  <input type="submit" name="submit" value="ganti password">

  <?php if( !empty($errors) ) { ?>
  	<div>
  		<?php foreach ($errors as $error) : ?>
  			<li><?php echo $error ?></li>
  		<?php endforeach ?>
  	</div>
  <?php } ?>
  
</form>

<?php require_once "templates/footer.php"; ?>