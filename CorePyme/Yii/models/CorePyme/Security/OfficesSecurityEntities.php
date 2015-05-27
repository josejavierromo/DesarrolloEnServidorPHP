<?php

namespace app\models\CorePyme\Security;

use Yii;
use app\models\Common\Record;
use app\models\CorePyme\Security\Offices;
use app\models\CorePyme\Security\SecurityEntities;

/**
 * This is the model class for table "OfficesSecurityEntities".
 *
 * @property integer $IdOfficeSecurityEntity
 * @property string $IdOffice
 * @property integer $IdSecurityEntity
 * @property string $Since
 */
class OfficesSecurityEntities extends Record
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'OfficesSecurityEntities';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['IdSecurityEntity'], 'integer'],
            [['Since'], 'safe'],
            [['IdOffice'], 'string', 'max' => 36]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'IdOfficeSecurityEntity' => Yii::t('app', 'Id Office Security Entity'),
            'IdOffice' => Yii::t('app', 'Centro'),
            'IdSecurityEntity' => Yii::t('app', 'Usuario'),
            'Since' => Yii::t('app', 'Acceso desde el'),
        ];
    }

    /**
    * Gets the office. The security entity has permission for login in this office.
    *
    * @return Offices|null
    */
    public function getOffice()
    {
        return $this->hasOne(Offices::className(),['IdOffice' => 'IdOffice']);
    }

    /**
    * Gets the security entity. Specify the security entity for login in the specified office.
    *
    * @return SecurityEntities|null
    */
    public function getSecurityEntity()
    {
        return $this->hasOne(SecurityEntities::className(),['IdSecurityEntity' => 'IdSecurityEntity']);
    }

    /**
    * Gets the specified login permission
    *
    * @return OfficesSecurityEntities|null
    */
    public function getPermission($idOffice,$idSecurityEntity)
    {
        return OfficesSecurityEntities::findOne(['IdOffice' => $idOffice, 'IdSecurityEntity' => $idSecurityEntity]);
    }

    /**
    * Gets the allowed offices for the current user
    *
    * @param SecurityEntities
    *   The security entity to be searched
    * @return OfficesSecurityEntities|null
    */
    public function getOffices($idSecurityEntity)
    {
        return OfficesSecurityEntities::find()->where(['IdSecurityEntity' => $idSecurityEntity]);
    }

    /**
    * Gets, if exists, the permission for login
    *
    */
    public function getOfficesEntity($idOffice,$idSecurityEntity)
    {
        return OfficesSecurityEntities::findOne(['IdSecurityEntity' => $idSecurityEntity,
                                                 'IdOffice' => $idOffice,
                                                ]);
    }

}
