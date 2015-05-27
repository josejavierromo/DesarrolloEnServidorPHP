<?php

namespace app\models\CorePyme\Log;

use Yii;
use yii\base\ErrorException;
use app\models\CorePyme\Security\SecurityEntities;
use app\models\CorePyme\Security\Offices;
use app\models\CorePyme\Log\Sessions;
use app\models\Common\Record;
use app\models\CorePyme\Security\Devices;
use app\models\CorePyme\Security\DeviceTypes;

/**
 * This is the model class for table "Sessions".
 *
 * @property integer $IdSession
 * @property integer $IdSecurityEntity
 * @property integer $IdDevice
 * @property string $AccesDate
 * @property string $EndDate
 */
class Sessions extends Record
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Sessions';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('dbLog');
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['IdOffice'], 'string', 'max' => 36],
            [['IdSecurityEntity', 'IdDevice', 'expire'], 'integer'],
            [['AccesDate', 'EndDate', 'data'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'id'),
            'IdOffice' => Yii::t('app', 'Id Office'),
            'IdSecurityEntity' => Yii::t('app', 'Id Security Entity'),
            'IdDevice' => Yii::t('app', 'Id Device'),
            'AccesDate' => Yii::t('app', 'Acces Date'),
            'EndDate' => Yii::t('app', 'End Date'),
            'expire' => Yii::t('app', 'Expire'),
            'data' => Yii::t('app', 'Data'),
        ];
    }

    /**
    * Gets the security entity of the current session
    */
    public function getSecurityEntity()
    {
        return $this->hasOne(SecurityEntities::className(), ['IdSecurityEntity'=>'IdSecurityEntity']);
    }

    /**
    * Gets the office of the current session
    * 
    * @return Offices|null
    */
    public function getOffice()
    {
        return $this->hasOne(Offices::className(), ['IdOffice' => 'IdOffice']);
    }

    /**
    * Gets the device of the current session
    *
    * @return Devices|null
    */
    public function getDevice()
    {
        return $this->hasOne(Devices::className(), ['IdDevice' => 'IdDevice']);
    }

    /**
    * Gets all active sessions at the moment
    * 
    * @return Sessions(array)|null
    */
    public function getActiveSessions()
    {
        return Sessions::find()
               ->where(['EndDate' => null])
               ->orderBy('AccesDate')
               ->all();
    }

    /**
    * Gets all sessions at date specified
    *
    * @param DateTime $date
    *   Date to be searched
    * @return Sessions(array)|null
    */
    public function getSessions($date)
    {
        return Sessions::find()
               ->where(['AccesDate'=> $date])
               ->orderBy('AccessDate')
               ->all();
    }

    /**
    * Gets the session information
    *
    * @param string $id
    *   Id Session to be searched
    * @return Sessions|null
    */
    public function getSession($id)
    {
        return Sessions::findOne($id);
    }

    /**
    * Creates the new session after user validation
    * 
    * @return boolean
    */
    public function createSession($securityEntity)
    {
        $session = null;
        $device = Devices::registerDevice(Yii::$app->request->getUserHost(),
                                          Yii::$app->request->getUserIP(),
                                          DeviceTypes::web);

        if(Yii::$app->user->isGuest)
        {
            //user credentials validation
            if(Yii::$app->user->login($securityEntity, 0))
            {
                Yii::$app->session->init();
                Yii::$app->session->open();

                if($session = self::getSession(Yii::$app->session->getId()) === null)
                {
                    $session = new Sessions();
                    $session->loadDefaultValues();

                    $session->id = Yii::$app->session->getId();
                    $session->expire = Yii::$app->session->timeout;
                }
                else
                {
                    Yii::$app->session->regenerateID();
                    $session = self::getSession(Yii::$app->session->getId());
                }
                $session->IdDevice = $device->IdDevice;
                $session->IdSecurityEntity = $securityEntity->IdSecurityEntity;
                $session->AccesDate = date('Y-m-d H:i:s');
                $session->EndDate = null;
                $session->IdOffice = '0000-0000';
                $session->save();
            }
            else
            {
                return false;
            }
        }

        return true;
    }

    /**
    * Close the current session 
    */
    public function closeSession()
    {
        $session = self::getSession(Yii::$app->session->getId());
        Yii::$app->user->logout(false);
        $session->EndDate = date('Y-m-d H:i:s');
        $session->save();
    }

    /**
    * Update the idOffice into session object, also if the field IdOffice in device object isn't fill, to be asigned it.
    *
    * @param integer @idOffice
    *   Id Office to be asigned to session object
    */
    public function updateOfficeSession($idOffice)
    {
        $session = self::getSession(Yii::$app->session->getId());
        $session->IdOffice = $idOffice;

        if($session->device->IdOffice == '0000-0000')
        {
            $session->device->IdOffice = $idOffice;
            $session->device->save();
        }

        $session->save();
    }

}
