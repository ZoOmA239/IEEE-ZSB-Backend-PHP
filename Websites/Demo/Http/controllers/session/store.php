<?php

use Core\Authenticator;
use Http\Forms\LoginForm;


$form = LoginForm::validate($atrributes =
    [
        'email' => $_POST['email'],
        'password' => $_POST['password']
    ]);


$signedIn = (new Authenticator)->attempt($atrributes['email'], $atrributes['password']);

if (! $signedIn) {
    $form->error("email", "No matching account for this email and password")->throw();
}

redirect("/");
