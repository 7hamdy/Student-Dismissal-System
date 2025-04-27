<?php
require './class/db.php';
require './class/model.php';
require './class/tables.php';
require './class/user.php';
require './class/profile.php';
require './includes/core.php';

lockRedirect();

$mTtl = "Profile - ".$config['site_name'];
$mKw = '';
$mDesc = '';

require './includes/header.php';
$activeMenu = 'profile.php';
require './includes/nav.php';
?>
<div class="container">
	<!-- Page title -->
	<div class="page-header d-print-none">
		<div class="row">
			<div class="col">
				<h2 class="page-title">
					Profile
				</h2>
			</div>
		</div>
	</div>
</div>
<section class="my-3">
	<div class="container">
		<div class="row">

			<div class="col-md-8 mb-3">
				<div class="rounded bg-white p-3">
					<div class="f-125 b-6 mb-3">Account Info</div>
					<?= profileClass::nameForm() ?>
				</div>
			</div>

			<div class="col-md-4 mb-3">
				<div class="rounded bg-white p-3">
					<div class="f-125 b-6 mb-3">Change Password</div>
					<?= profileClass::change_password_form() ?>
				</div>
			</div>

		</div>
	</div>
</section>

<?php
require 'includes/footer-html.php';
require 'includes/footer.php';
?>