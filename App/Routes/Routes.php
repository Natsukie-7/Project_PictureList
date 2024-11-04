<?php

return [
    "get" => [
        "/" => "HomeController@index",
        "/login" => "AuthenticationController@renderLoginView"
    ],
    "post" => []
];