<?php

namespace app\models;

use Yii;
use yii\base\Model;
use app\models\CorePyme\Security\SecurityEntities;
use app\models\CorePyme\Security\SecurityEntityTypes;
use app\models\CorePyme\Log\Sessions;

/**
 * LoginForm is the model behind the login form.
 */
class LoginForm extends Model
{
    public $username;
    public $password;
    public $rememberMe = true;

    private $_user = false;


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            ['username', 'required', 'message' => Yii::t('app','Por favor, escriba un nombre de usuario')],
            ['password', 'required', 'message' => Yii::t('app','Por favor, escriba una contraseña')],
            // rememberMe must be a boolean value
            ['rememberMe', 'boolean'],
            // password is validated by validatePassword()
            ['password', 'validatePassword'],
        ];
    }

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {

        $user = $this->getUser();

        if (!$user || !$user->validatePassword($this->password)) {
            $this->addError($attribute, 'Incorrect username or password.');
        }
        }
    }

    /**
     * Logs in a user using the provided username and password.
     *
     * @return boolean whether the user is logged in successfully
     */
    public function login()
    {
        $user = $this->getUser();
        if ($this->validate()) 
        {
            //return Yii::$app->user->login($user, $this->rememberMe ? 3600*24*30 : 0);
            return Sessions::createSession($user);
        }
        else 
        {
            return false;
        }
    }

    /**
     * Finds user by [[username]]
     *
     * @return SecurityEntities|null
     */
    public function getUser()
    {
        if ($this->_user === false) {
            $this->_user = SecurityEntities::getSecurityEntityByName($this->username, SecurityEntityTypes::user);
        }

        return $this->_user;
    }
}
