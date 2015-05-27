<?php

namespace app\models\CorePyme\Security;

use Yii;
use app\models\Common\Record;
use app\models\CorePyme\Security\Offices;

/**
 * This is the model class for table "Companies".
 *
 * @property integer $IdCompany
 * @property string $TradeName
 * @property string $CorporateName
 * @property string $CIF
 * @property string $Notes
 */
class Companies extends Record
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Companies';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['TradeName', 'CorporateName', 'CIF', 'Notes'], 'required'],
            [['TradeName'], 'string', 'max' => 50],
            [['CorporateName'], 'string', 'max' => 70],
            [['CIF'], 'string', 'max' => 15],
            [['Notes'], 'string', 'max' => 255],
            [['Logo'], 'file', 'extensions' => 'gif, jpg, png'],
            [['CIF'],'validateCIF'],
            [['TradeName'],'validateTradeName'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'IdCompany' => Yii::t('app', 'Id Empresa'),
            'TradeName' => Yii::t('app', 'Razón social'),
            'CorporateName' => Yii::t('app', 'Nombre comercial'),
            'CIF' => Yii::t('app', 'C.I.F'),
            'Notes' => Yii::t('app', 'Observaciones'),
        ];
    }

    /**
    * Gets all offices of the current company
    *
    * @return Offices(array)|null
    */
    public function getOffices()
    {
        return $this->hasMany(Offices::className(),['IdCompany' => 'IdCompany']);
    }

    /**
    * Gets the information company
    *
    * @param integer @id
    *   Id Company to be searched
    * @return Companies|null
    */
    public function getCompany($id)
    {
        return Companies::findOne(['IdCompany' => $id]);
    }

    /**
    * Gets all registered companies
    *
    * @return yii\db\ActiveQuery|null
    */
    public function getCompanies()
    {
        return Companies::findBySql('SELECT * FROM Companies');
    }

    /**
    * Gets the information company
    *
    * @param string @number
    *   National identification number of the company to be searched
    * @return Companies|null
    */
    public function getCompanyByNumber($number)
    {
        return Companies::findOne(['CIF' => $number]);
    }

    /**
    * Gets the information company
    *
    * @param string @name
    *   Company name to be searched
    * @return Companies|null
    */
    public function getCompanyByTradeName($name)
    {
        return Companies::findOne(['TradeName' => $name]);
    }

    /**
    * Check if exists a company with the same national identificacion numbere that the current company
    *
    */
    public function validateCIF($argument,$params)
    {
        if (!$this->hasErrors()) 
        {
            if (Companies::getCompanyByNumber($this->CIF) !== null) 
            {
                $this->addError($argument, Yii::t('app','Ya existe este CIF'));
            }
        }
    }

    /**
    * Check if exists a company with the same trade name that the current company
    *
    */
    public function validateTradeName($argument,$params)
    {
        if(!$this->hasErrors())
        {
            if(Companies::getCompanyByTradeName($this->TradeName) !== null)
            {
                $this->addError($argument, Yii::t('app','Ya existe esta razón social'));
            }
        }
    }
}
