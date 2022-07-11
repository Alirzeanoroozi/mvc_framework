<?php

namespace Alireza\Untitled\models;

use Alireza\Untitled\core\Application;

class LoginModel extends Model
{
    public string $email = "";
    public string $password = "";

    public function rules()
    {
        return [
            'email' => [self::RULE_REQUIRED, self::RULE_EMAIL],
            'password' => [self::RULE_REQUIRED],
        ];
    }

    public function label() : array
    {
        return [
            'email' => 'Email',
            'password' => 'Password'
        ];
    }

    public function login()
    {
        $user = (new User)->findOne(['email' => $this->email]);
        if(!$user){
            $this->addError('email', 'User Does Not Exists');
            return false;
        }

        if(!password_verify($this->password, $user->password)){
            $this->addError('password', 'Password is incorrect');
            return false;
        }

        return Application::$app->login($user);
    }
}