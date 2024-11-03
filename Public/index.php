<?php

$data = ["name" => "nathan", "age" => 18];

ob_start();

extract($data);


require "./Home.php";

$content = ob_get_contents();

ob_end_clean();


echo $content;