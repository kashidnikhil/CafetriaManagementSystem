<?php
	session_start();

	if(isset($_SESSION['emp_user'])) {
		session_destroy();
		header("location: employee.php");
	} else {
		session_destroy();
		header("location: customer.php");
	}
?>