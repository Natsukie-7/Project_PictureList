<?php 

if (isset($childScripts))  {
    foreach($childScripts as $script) {
        echo '<script src="' . $script . '"></script>';
    }
} 