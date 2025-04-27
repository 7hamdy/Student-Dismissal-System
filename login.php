<?php
/////
require './class/db.php';
require './class/model.php';
require './class/tables.php';
require './class/user.php';
require './includes/core.php';
$mTtl = 'Login Page';
$mKw = '';
$mDesc = '';
require './includes/header.php';
$return = 0;
?>

<div class="wrap-split">

  <div class="wrap-split-right bg-white p-5">
   
  <div class="pt-5" >
      <div class="text-center" >
        <h1 class="pt-2" style="color:#183288"><?=$config['site_name']?></h1>
      </div>
      <div class="pt-5">

        <?php userClass::showForm('login',$return)?>
      </div>

    </div>
  </div>

  <div class="wrap-split-left" style="background-color: #EFBF42; padding: 5rem; text-align: center;">
  <div class="mt-5">
    <img src="./assets/img/logo.png" class="w-75" alt="">
    <h2 class="text-white mt-5"></h2>
  </div>
</div>

</div>

<?php
// require 'includes/footer-html.php';
require 'includes/footer.php';
?>