<?php

return [
    "get" => [
        "/" => "HomeController@index",
        "/login" => "AuthenticationController@renderLoginView:public",
        "/register" => "AuthenticationController@renderRegisterView:public",
        "/logout" => "AuthenticationController@logout",
        "/new-content" => "FilesController@index",
        "/get-all-files" => "FilesController@requestAllFiles",
        "/file" => "FilesController@renderFilePage",
    ],
    "post" => [
        "/login/request-login" => "AuthenticationController@loginAuthentication:public",
        "/register/request-register" => "AuthenticationController@registerUser:public",
        "/upload-file" => "FilesController@upload"
    ],
];