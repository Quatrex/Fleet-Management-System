<?php

namespace Validator;

class Authenticate
{
    public static function authenticateMe()
    {
        if (!empty($_POST)) {

            // if (Token::check($_POST['token'])){

            $validate = new Validate();
            $validation = $validate->check($_POST, array(
                'username' => array('required' => true),
                'password' => array('required' => true),
            ));

            if ($validation->passed()) {
                $user = new User();

                $remember = (isset($_POST['remember']) ? "on" : "off" === 'on') ? true : false;
                $result = $user->login(filter_var($_POST['username'], FILTER_SANITIZE_STRING), filter_var($_POST['password'], FILTER_SANITIZE_STRING), $remember);
                if ($user->isLoggedIn()) {
                    echo '../index.php';
                } else {

                    return $result;
                }
            } else {
                foreach ($validation->errors() as $error) {
                    echo $error, '<br>';
                }
            }
            // }
        }
    }
}
