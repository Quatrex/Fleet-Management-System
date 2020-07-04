<?php

namespace Validator;

class Authenticate
{
    public static function authenticateMe()
    {
        if (!empty($_POST)) {

            $validate = new Validate();
            $validation = $validate->check($_POST, array(
                'username' => array('required' => true),
                'password' => array('required' => true),
            ));

            if ($validation->passed()) {
                $user = new User();

                $remember = (isset($_POST['remember']) ? "on" : "off" === 'on') ? true : false;
                $result = $user->login($_POST['username'], $_POST['password'], $remember);
                if ($user->isLoggedIn()) {
                    $position=$result;
                    if ($position == 'jo' || $position == 'JO') {
                        echo '../Layout/jo.php';
                    } elseif (($position == 'cao' || $position == 'CAO')) {
                        echo '../Layout/cao.php';
                    } elseif (($position == 'vpmo' || $position == 'VPMO')) {
                        echo '../Layout/vpmo.php';
                    } else {
                        echo '../index.php';
                    }
                } else {

                    return $result;
                }
            } else {
                foreach ($validation->errors() as $error) {
                    echo $error, '<br>';
                }
            }
        }
    }
}
