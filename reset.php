<?php
require './class/db.php';
require './class/model.php';
require './class/tables.php';

require './class/email.php';
require './class/user.php';
require './includes/core.php';

$mTtl = 'Reset password - '.$config['site_name'];
$mKw = '';
$mDesc = '';

require './includes/header.php';
$activeMenu = 'reset.php';
// require './includes/nav.php';

if(isset($_SESSION['uid'])) echo '<script>window.location.href = "./index.php"</script>';

if(isset($_GET['email']) || isset($_GET['code'])){
    $email = model::secure($_GET['email']);
    $code = model::secure($_GET['code']);
    $user = userClass::checkHash($email,$code);
    if(!$user) echo '<script>window.location.href = "./index.php"</script>';
?>
    <section class="py-5">
    	<div class="container">
    		<div class="row justify-content-center">
    			<div class="col-md-6">
    				<div class="border text-center p-5 bg-white">
    					<h2>Reset your password</h2>
    					<p class="mb-4">Please enter your new password.</p>
							<?= userClass::reset_form2($email,$code);?>
    				</div>
    			</div>
    		</div>
    	</div>
    </section>
<?php
}

if(!isset($_GET['email']) || !isset($_GET['code'])){
?>
<section class="my-5 py-5">
	<div class="container">
		<div class="row justify-content-center ">
			<div class="col-lg-6">
				<div class="border text-center p-5 bg-white">
					<h1 class="mb-2"><i class="fa fa-key" aria-hidden="true"></i></h1>
					<h2>Forgot password?</h2>
					<p class="mb-4">Enter your email, we will then start the reset process.</p>
					<?= userClass::reset_form1() ?>
				</div>
			</div>
		</div>
	</div>
</section>
<?php
}

// require 'includes/footer-html.php';
require 'includes/footer.php';
?>