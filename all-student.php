<?php 
require './class/db.php';
require './class/model.php';
require './class/tables.php';
require './includes/core.php';
require './class/system.php';
require './includes/header.php';
// require './includes/nav.php';

?>

<hr>
<!-- start data table -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
<!-- end data table -->

<!-- start section -->
<section class="my-5 ">
	<div class="container">


		<div class="shadow bg-white p-3 mt-3">
			<h4 class="mb-4">student<?php
?>

</h4> </h4>
			<?php systemClass::student_table();?>
		</div>

	</div>
</section>
<!-- end section -->
<hr>



<?php require './includes/footer.php';?>

