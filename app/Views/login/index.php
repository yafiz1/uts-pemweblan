
<?php
	$session = \Config\Services::session();
	if ($session->has('register')) {
		if ($session->get('register') == 'success') {
			echo "<script>alert('Pendaftaran Berhasil');</script>";
		}else if ($session->get('register') == 'failed'){
			echo "<script>alert('Pendafaran Gagal');</script>";
		}
	}else if ($session->has('login')) {
		if ($session->get('login') == 'failed') {
			echo "<script>alert('Username atau password salah!');</script>";
		}
	}
	
 ?>

 		
<div class="d-flex justify-content-center mt-5">
		<?php 

			$login_username =  [
			       'name' => 'login-username',
			       'id'   => 'login-username',
			       'class' => 'form-control',
			       'autocomplete' => 'off',
			       'required' => ''
			];

			$login_password =  [
			       'name' => 'login-password',
			       'id'   => 'login-password',
			       'type' => 'password',
			       'class' => 'form-control',
			       'required' => '',
			       'autocomplete' => 'off'
			];

		?>
		<div class="card text-center shadow bg-dark text-white w-25 align-self-start">
			<div class="card-header">
				<b><h4>Login</h4></b>
			</div>
			<div class="card-body text-right">
				<?= form_open(base_url().'/Login/login') ?>
					<div class="form-group text-left">
						<?= form_label('Username', 'login-username'); ?>
		   				<?= form_input($login_username); ?>
					</div>
					<div class="form-group text-left">
						<?= form_label('Password', 'login-password'); ?>
		   				<?= form_input($login_password); ?>
					</div>
					<button type="submit" id="login" class="btn btn-secondary w-100">Login</button>
				<?= form_close(); ?>
				<!-- </form> -->
			</div>
		</div>

		<?php 

		$nama = [
		       'name' => 'register-name',
		       'id'   => 'register-name',
		       'class' => 'form-control',
		       'required' => '',
		       'autocomplete' => 'off'
		];
		$register_username =  [
		       'name' => 'register-username',
		       'id'   => 'register-username',
		       'class' => 'form-control',
		       'required' => '',
		       'autocomplete' => 'off'
		];

		$register_password =  [
		       'name' => 'register-password',
		       'id'   => 'register-password',
		       'type' => 'password',
		       'class' => 'form-control',
		       'required' => '',
		       'autocomplete' => 'off'
		];

		$confirm_register_password =  [
		       'name' => 'confirm-register-password',
		       'id'   => 'confirm-register-password',
		       'type' => 'password',
		       'class' => 'form-control',
		       'required' => '',
		       'autocomplete' => 'off'
		];

		?>

		<div class="card text-center shadow bg-dark text-white ml-5 align-self-center" style="padding: 10px;">OR</div>
		<div class="card text-center shadow bg-dark text-white w-25 ml-5">
			<div class="card-header">
				<b><h4>Register</h4></b>
			</div>
			<div class="card-body text-right">
				<?= form_open(base_url().'/Login/register') ?>
					<div class="form-group text-left">
						<?= form_label('Nama Lengkap', 'register-name'); ?>
		   				<?= form_input($nama); ?>
					</div>
					<div class="form-group text-left">
						<?= form_label('Username', 'register-username'); ?>
		   				<?= form_input($register_username); ?>
					</div>
					<div class="form-group text-left">
						<?= form_label('Password', 'register-password'); ?>
		   				<?= form_input($register_password); ?>
					</div>
					<div class="form-group text-left">
						<?= form_label('Konfirmasi Password', 'confirm-register-password'); ?>
		   				<?= form_input($confirm_register_password); ?>
					</div>
					<button type="submit" id="register" class="btn btn-secondary w-100">Register</button>
				<?= form_close(); ?>
			</div>
		</div>	
</div>

<script>
	$("input#login-username").keyup(function() {
		if ($(this).val() != "") {
			$(this).addClass("is-valid");
		}else{
			$(this).removeClass("is-valid");
		}
	});
	$("input#login-password").keyup(function() {
		if ($(this).val() != "") {
			$(this).addClass("is-valid");
		}else{
			$(this).removeClass("is-valid");
		}
	});

	$("input#register-name").keyup(function() {
		if ($(this).val() != "") {
			$(this).addClass("is-valid");
		}else{
			$(this).removeClass("is-valid");
		}
	});
	$("input#register-username").keyup(function() {
		if ($(this).val() != "") {
			$(this).addClass("is-valid");
		}else{
			$(this).removeClass("is-valid");
		}
	});
	$("input#register-password").keyup(function() {
		if ($(this).val() != "") {
			$(this).addClass("is-valid");
		}else{
			$(this).removeClass("is-valid");
		}
	});
	$("input#confirm-register-password").keyup(function() {
		if ($(this).val() == $("#register-password").val()) {
			$(this).removeClass("is-invalid");
			$(this).addClass("is-valid");
		}else if ($(this).val() != $("#register-password").val()) {
			$(this).addClass("is-invalid");
		}else{
			$(this).removeClass("is-valid");
			$(this).removeClass("is-invalid");
		}
	})
	$("button#register").click(function(event) {
		if ($("#register-password").val() != "" && $("#confirm-register-password").val() != "") {
			if ($("#register-password").val() != $("#confirm-register-password").val()) {
				$("input#confirm-register-password").focus();
				event.preventDefault();
			}
		};
		
	});
</script>