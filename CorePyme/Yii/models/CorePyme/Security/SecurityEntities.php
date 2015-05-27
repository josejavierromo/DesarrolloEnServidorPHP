<?php

namespace app\models\CorePyme\Security;

use Yii;
use app\models\CorePyme\Log\Sessions;
use app\models\Common\Record;

/**
 * This is the model class for table "SecurityEntities".
 *
 * @property integer $IdSecurityEntity
 * @property integer $IdEntityType
 * @property integer $IdSecurityEntityRelated
 * @property integer $IdUILanguage
 * @property integer $IdPrintLanguage
 * @property string $Name
 * @property string $Description
 * @property string $Password
 * @property string $Notes
 */
class SecurityEntities extends Record implements \yii\web\IdentityInterface
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'SecurityEntities';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Name','Password','Description'], 'required'],
            [['IdEntityType', 'IdSecurityEntityRelated', 'IdUILanguage', 'IdPrintLanguage'], 'integer'],
            [['Name', 'Password'], 'string', 'max' => 60],
            [['Description'], 'string', 'max' => 125],
            [['Notes'], 'string', 'max' => 255],
            [['AuthKey', 'AccessToken'], 'string', 'max' => 36],
            [['Validated'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'IdSecurityEntity' => Yii::t('app', 'Id Entidad de seguridad'),
            'IdEntityType' => Yii::t('app', 'Tipo de entidad'),
            'IdSecurityEntityRelated' => Yii::t('app', 'Pertenece a'),
            'IdUILanguage' => Yii::t('app', 'Idioma'),
            'IdPrintLanguage' => Yii::t('app', 'Idioma de impresión'),
            'Name' => Yii::t('app', 'Nombre de entidad'),
            'Description' => Yii::t('app', 'Nombre'),
            'Password' => Yii::t('app', 'Contraseña'),
            'AuthKey' => Yii::t('app','AuthKey'),
            'AccessToken' => Yii::t('app','AccessToken'),
            'Validated' => Yii::t('app','Permitir acceso'),
            'Notes' => Yii::t('app', 'Observaciones'),
        ];
    }

    public function getPermissions()
    {
        return $this->hasMany(Permissions::className(), ['IdSecurityEntity' => 'IdSecurityEntity']);
    }

    /**
    * Gets the security entity related with the current security entity. 
    * The related entity can be group or role.
    *
    * @return SecurityEntities|null
    */
    public function getSecurityEntityRelated()
    {
        return $this->hasOne(SecurityEntities::className(),['IdSecurityEntityRelated' => 'IdSecurityEntity'])->one();
    }

    /**
    * Find entity by name and type
    *
    * @param string $name 
    *   Name of entity to be searched
    * @param SecurityEntityTypes $idSecurityType 
    *   Type of entity to be searched
    * @return static|null 
    *   Return the security entity found.
    */
    public function getSecurityEntityByName($name,$idSecurityType)
    {
        return SecurityEntities::findOne(['Name'=>$name,'IdEntityType'=>$idSecurityType,'Validated' => 1]);
    }

    /**
    * Validates password of current user
    *
    * @param SecurityEntities $user
    *   User information 
    * @param $password
    *   Password input from interface
    * @return boolean
    *   Return true if correct validation, else return false
    */
    public function validatePassword($password)
    {
        if($this->Password === md5($password))
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    /**
    * Invoke before save the information of current user
    * Encrypt the password to md5 alghorythm
    *
    * @return boolean
    */
    public function beforeSave()
    {
        if($this->getIsNewRecord())
        {
            $this->Password = md5($this->Password);
            $this->AuthKey = $this->IdSecurityEntity."key";
            $this->AccessToken = $this->IdSecurityEntity."-token";
        }
        else
        {
            if($this->Password !== md5($this->Password))
            {
                $this->Password = md5($this->Password);
            }
        }
        return true;
    }

    /**
    * Gets all sessions of the current user
    */
    public function getSessions()
    {
        return $this->hasMany(Sessions::className(),['IdSecurityEntity' => 'IdSecurityEntity']);
    }

    public function getSecurityEntity()
    {
        return $this->hasOne(SecurityEntities::className(), ['IdSecurityEntity' => 'IdSecurityEntityRelated']);
    }

    public function getSecurityEntities()
    {
        return $this->hasMany(SecurityEntities::className(),['IdSecurityEntityRelated' => 'IdSecurityEntity']);
    }

    public function getAllSecurityEntities($type)
    {
        return SecurityEntities::find()->where(['IdEntityType' => $type]);
    }

    /**
     * Find the security entity by Id
     *
     * @param int $id 
     * @return SecurityEntity|null
     */
    public static function findIdentity($id)
    {
        return SecurityEntities::findOne(['IdSecurityEntity'=>$id]);
    }

    /**
     * Find the security entity by access token
     *
     * @param $token
     * @param $type
     * @return SecurityEntities|null
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return SecurityEntities::findOne(['AccessToken' => $token,'Validated' => 1]);
    } 

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->IdSecurityEntity;
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->AuthKey;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->AuthKey === $authKey;
    }

    /**
    * Gets description of the current type security entity
    *
    * @return string
    */
    public function getSecurityEntityType()
    {
        switch($this->IdEntityType)
        {
            case SecurityEntityTypes::user:
                return Yii::t('app','Usuario');
            case SecurityEntityTypes::group:
                return Yii::t('app','Grupo');
            case SecurityEntityTypes::role:
                return Yii::t('app','Rol');
        }
    }

    public function IdUILanguage()
    {
        return $this->getLanguage($this->IdUILanguage);
    }

    public function IdPrintLanguage()
    {
        return $this->getLanguage($this->IdPrintLanguage);
    }
}
