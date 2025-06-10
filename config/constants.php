<?php
return [
    'user' => [
        'validations' => [
            'firstNameRequired' => 'firstNameRequired',
            'lastNameRequired' => 'lastNameRequired',
            'emailRequired' => 'emailRequired',
            'emailInvalid' => 'emailInvalid',
            'phoneRequired' => 'phoneRequired',
            'phoneInvalid' => 'phoneInvalid',
            'passwordRequired' => 'passwordRequired',
            'repeatPasswordRequired' => 'repeatPasswordRequired',
            'passwordLengthNotMatch' => 'passwordLengthNotMatch',
            'invalidPassword' => 'invalidPassword',
            'passwordNotMatch' => 'passwordNotMatch',
            'emailExists' => 'emailExists',
            'insertDataExceptionError' => 'insertDataExceptionError',
        ],
        'success' => [
            'userCreated' => 'userCreated',
        ],
        'userAccessToken' => 'Personal Access Token',
    ],
    'patterns' => [
        'email' => '/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/',
        'mobile' => '/^[0-9]*$/',
        'password' => '/^(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])(?=.*[!-\\/:-@[-`{-~])[a-zA-Z0-9!-\\/:-@[-`{-~]{8,}/',
    ],
];