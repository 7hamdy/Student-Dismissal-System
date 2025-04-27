<?php
require './class/db.php';
require './class/model.php';
require './class/tables.php';
require './class/user.php';
require './includes/core.php';

$mTtl = 'Verify your account - '.$config['site_name'];
$mKw = '';
$mDesc = '';

require './includes/header.php';
$activeMenu = 'verify.php';
require './includes/nav.php';

$email = $hash = '';
if(isset($_GET['email']) && isset($_GET['code']) && !empty($_GET['code']) && !empty($_GET['email'])){
  $email = model::secure($_GET['email']);
  $hash = model::secure($_GET['code']);
}
?>
<div class="container">
  <!-- Page title -->
  <div class="page-header d-print-none">
    <div class="row">
      <div class="col">
        <h2 class="page-title">
          Verify your account
        </h2>
      </div>
    </div>
  </div>
</div>
<section class="my-3">
  <div class="container">
    <div class="bg-white p-5 rounded mx-1">
    <div class="text-center">
      <?php 
      $res = userClass::verify($email,$hash);
      switch ($res['status']) {
        case 'success':
          echo '
          <span class="fa fa-check text-success"></span>
          <div class="mt-4 text-success">Verified!</div>
          <p class="mb-5">'.$res['msg'].'</p>';
          break;
        case 'verified':
          echo '
          <span class="fa fa-check text-success"></span>
          <div class="mt-4 text-success">Verified!</div>
          <p class="mb-5">'.$res['msg'].'</p>';
          break;
        break;
        case 'failed':
          echo '
          <span class="fa fa-times text-danger"></span>
          <h1 class="mt-4 text-danger">Error!</h1>
          <p>'.$res['msg'].'</p>
          <a href="./index.php" class="text-secondary">Back to home</a>';
          break;
        break;
      }
      ?>

      <?php
      if ($res['status'] == 'success' || $res['status'] == 'verified') {
      ?>
        <!-- <hr> -->
        <div class="border p-5 my-5">
          <h3 class="text-secondary">Ready to go!</h3>
          <p class="">Your Landing Page design in just a few clicks</p>
          <div class="mt-5">
            <a href="./make-order.php">
              <span class="btn btn-outline-warning py-3 px-5">Create new order</span>
            </a>
          </div>
        </div>
      <?php } ?>

    </div>
    </div>
  </div>
</section>

<?php
if (ucheck()){
  $user = users::find($uid);
}
require 'includes/footer-html.php';
require 'includes/footer.php';
?>