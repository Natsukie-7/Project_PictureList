<?php

return [
    "get" => [
        "/" => "HomeController@index",
        "/login" => "AuthenticationController@renderLoginView:public",
        "/logout" => "AuthenticationController@logout"
    ],
    "post" => [
        "/login/request-login" => "AuthenticationController@loginAuthentication"
    ],
];