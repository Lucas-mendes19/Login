<?php

use Project\System\Controller\ControllerChangePassword;
use Project\System\Controller\ControllerControlPanel;
use Project\System\Controller\ControllerLogin;
use Project\System\Controller\ControllerLogout;
use Project\System\Controller\ControllerRecoverPassword;
use Project\System\Controller\ControllerRegisterUser;
use Project\System\Controller\ControllerValidateLogin;
use Project\System\Controller\ControllerValidateRegisterUser;
use Project\System\Controller\ControllerSendPasswordChangeEmail;
use Project\System\Controller\ControllerValidateChangePassword;

return [
    '/login' => ControllerLogin::class,
    '/login/validate' => ControllerValidateLogin::class,
    '/recover/password' => ControllerRecoverPassword::class,
    '/user/send/email/code' => ControllerSendPasswordChangeEmail::class,
    '/change/user/password' => ControllerChangePassword::class,
    '/change/user/password/validate' => ControllerValidateChangePassword::class,
    '/controlPanel' => ControllerControlPanel::class,
    '/controlPanel/logout' => ControllerLogout::class,
    '/register/user' => ControllerRegisterUser::class,
    '/register/user/validate' => ControllerValidateRegisterUser::class,
];