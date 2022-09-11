<?php
    header('Access-Control-Allow-Origin: *');
    
    include "classes/Users.php";
    include "controller/Progress.php";
    include "classes/Rest.php"; 

    if (isset($_REQUEST) && !empty($_REQUEST)) {
		$rest = new Rest($_REQUEST);
		echo $rest->run();
	}