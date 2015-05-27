<?php

namespace app\models\CorePyme\Security;

use Yii;
use app\models\Common\Record;
use app\models\CorePyme\Security\Companies;
use app\models\CorePyme\Security\Devices;
use app\models\CorePyme\Security\OfficesSecurityEntities;

/**
 * This is the model class for table "Offices".
 *
 * @property string $IdOffice
 * @property integer $IdCompany
 * @property string $OfficeAlias
 * @property string $OfficeName
 * @property string $OffcieTradeName
 * @property string $CIF
 * @property string $OfficeCode
 * @property string $Colour
 */
class Offices extends Record
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Offices';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['OfficeAlias', 'OfficeName', 'OfficeCode', 'Colour'], 'required'],
            [['IdCompany'], 'integer'],
            [['IdOffice'], 'string', 'max' => 36],
            [['OfficeAlias'], 'string', 'max' => 30],
            [['OfficeName'], 'string', 'max' => 60],
            [['OffcieTradeName'], 'string', 'max' => 50],
            [['CIF'], 'string', 'max' => 15],
            [['OfficeCode'], 'string', 'max' => 10],
            [['Colour'], 'string', 'max' => 255],
            [['Logo'], 'string', 'max' => 125],
            [['CIF'], 'validateCIF'],
            [['OfficeCode'], 'validateCode'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'IdOffice' => Yii::t('app', 'Id Centro'),
            'IdCompany' => Yii::t('app', 'Id Empresa'),
            'OfficeAlias' => Yii::t('app', 'Alias'),
            'OfficeName' => Yii::t('app', 'Nombre'),
            'OffcieTradeName' => Yii::t('app', 'Razón social'),
            'CIF' => Yii::t('app', 'C.I.F'),
            'OfficeCode' => Yii::t('app', 'Código'),
            'Colour' => Yii::t('app', 'Color'),
        ];
    }

    /**
    * Invoke before save the information of current Office
    *
    * @return Boolean
    */
    public function beforeSave()
    {
        if($this->getIsNewRecord())
        {
            $this->IdOffice = $this->createGuid();
        }
        return true;
    }

    /**
    * Check if exists a office with the same national identificacion number that the current company
    *
    */
    public function validateCIF($argument,$params)
    {
        if (!$this->hasErrors()) 
        {
            if (Offices::getOfficeByIdentificacionNumber($this->CIF) !== null) 
            {
                $this->addError($argument, Yii::t('app','Ya existe este CIF'));
            }
        }
    }

    public function validateCode($argument,$params)
    {
        if(!$this->hasErrors())
        {
            if(Offices::getOfficeByCode($this->OfficeCode) !== null)
            {
                $this->addError($argument, Yii::t('app','Ya existe este código'));
            }
        }
    }


    /**
    * Gets company information of the current office
    *
    * @return Companies|null
    */
    public function getCompany()
    {
        return $this->hasOne(Companies::className(),['IdCompany' => 'IdCompany'])->one();
    }

    /**
    * Gets all devices registered from the current office
    *
    * @return Devices|null
    */
    public function getDevices()
    {
        return $this->hasMany(Devices::className(),['IdOffice' => 'IdOffice']);
    }

    /**
    * Gets all login permission for the current center
    *
    * @return OfficesSecurityEntity|null
    */
    public function getOfficesSecurityEntities()
    {
        return $this->hasMany(OfficesSecurityEntities::className(),['IdSecurityEntity' => 'IdSecurityEntity']);
    }

    /**
    * Gets all offices
    *
    * @return Offices(Array)|null
    */
    public function getAllOffices()
    {
        return Offices::find();
    }

    /**
    * Gets all offices of a company
    *
    * @param integer @idCompany
    *       Id Company to be searched
    *
    * @return Offices(Array)|null
    */
    public function getOffices($idCompany)
    {
        return Offices::find(['IdCompany' => $idCompany]);
    }

    /**
    * Gets office information
    *
    * @param integer $id
    *   Id Office to be searched
    * @return Offices|null
    */
    public function getOfficeById($id)
    {
        return Offices::findOne(['IdOffice' => $id]);
    }

    /**
    * Gets office information
    *
    * @param string $name 
    *       Name office to be searched
    *
    * @return Offices|null
    */
    public function getOfficeByName($name)
    {
        return Offices::findOne(['OfficeName' => $name]);
    }

    /**
    * Gets office information
    *
    * @param string $alias
    *       Alias office to be searched
    *
    * @return Offices|null
    */
    public function getOfficeByAlias($alias)
    {
        return Offices::findOne(['OfficeAlias' => $alias]);
    }

    /**
    * Gets office information
    *
    * @param string $code
    *       Code office to be searched
    *
    * @return Offices|null
    */
    public function getOfficeByCode($code)
    {
        return Offices::findOne(['OfficeCode' => $code]);
    }

    /**
    * Gets office information
    *
    * @param string $number
    *       Identification number to be searched
    * 
    * @return Offices|null
    */
    public function getOfficeByIdentificacionNumber($number)
    {
        return Offices::findOne(['CIF' => $number]);
    }

}
