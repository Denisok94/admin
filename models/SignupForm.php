<?php

namespace denisok94\admin\models;

use yii\base\Model;
use denisok94\admin\models\User;

/**
 * Signup form
 */
class SignupForm extends Model
{
    public $username;
    public $email;
    public $password;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['username', 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => '\denisok94\admin\models\User', 'message' => 'Такое логин уже занят.'],
            ['username', 'string', 'min' => 2, 'max' => 255],
            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\denisok94\admin\models\User', 'message' => 'Такая почта уже занята.'],
            ['password', 'required'],
            ['password', 'string', 'min' => 6],
        ];
    }
    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function signup()
    {
        if (!$this->validate()) {
            return null;
        }

        $user = new User();
        $user->username = $this->username;
        $user->email = $this->email;
        $user->setPassword($this->password);
        $user->generateAuthKey();
        $user->created_at = time();
        $user->updated_at = time();

        return $user->save() ? $user : null;
    }
}
