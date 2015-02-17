<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "Usuarios".
 *
 * @property integer $Codigo_usuario
 * @property string $Nombre_usuario
 * @property string $Contraseña
 * @property integer $Telefono_usuario
 * @property string $Email_usuario
 * @property string $Direccion
 *
 * @property Eventos[] $eventos
 */
class Usuarios extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Usuarios';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Nombre_usuario', 'Password', 'Email_usuario'], 'required'],
            [['Telefono_usuario'], 'integer'],
            [['Nombre_usuario', 'Password'], 'string', 'max' => 45],
            [['Email_usuario'], 'string', 'max' => 63],
            [['Direccion'], 'string', 'max' => 127]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Codigo_usuario' => 'Codigo Usuario',
            'Nombre_usuario' => 'Nombre Usuario',
            'Password' => 'Contraseña',
            'Telefono_usuario' => 'Telefono Usuario',
            'Email_usuario' => 'Email Usuario',
            'Direccion' => 'Direccion',
        ];
    }
	
	public function login($Nombre_usuario, $Password)
	{
		
		if($this->findOne(['Nombre_Usuario'=> $Nombre_usuario, 'Password'=> md5($Password)]) != null)
		{
			return true;
		}
		else
		{
			return false;
		}
	}

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEventos()
    {
        return $this->hasMany(Eventos::className(), ['Cod_usuario' => 'Codigo_usuario']);
    }
	
    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
		return Usuarios::findOne($id);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
		return Usuarios::findOne(['access_token' => $token]);
    }

    /**
     * Finds user by username
     *
     * @param  string      $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
		return Usuarios::findOne(['Nombre_usuario'=>$username]);
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->authKey;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->authKey === $authKey;
    }
}
