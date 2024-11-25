<?php

if (isset($childCss)) {
    foreach($childCss as $css) {
        echo '<link rel="stylesheet" href="' . $css . '">';
    }
} 