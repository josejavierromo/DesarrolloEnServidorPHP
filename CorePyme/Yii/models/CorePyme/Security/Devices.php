<?php

namespace app\models\CorePyme\Security;

use Yii;
use yii\base\ErrorException;
use app\models\CorePyme\Security\DeviceTypes;
use app\models\CorePyme\Security\Sessions;
use app\models\Common\Record;

/**
 * This is the model class for table "Devices".
 *
 * @property integer $IdDevice
 * @property string $IdOffice
 * @property integer $IdDeviceType
 * @property string $DeviceName
 * @property string $DeviceIdentifier
 * @property integer $AllowAcces
 */
class Devices extends Record
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Devices';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['IdDeviceType', 'AllowAcces'], 'integer'],
            [['DeviceName'], 'required'],
            [['IdOffice', 'DeviceIdentifier'], 'string', 'max' => 36],
            [['DeviceName'], 'string', 'max' => 80]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'IdDevice' => Yii::t('app', 'Id Dispositivo'),
            'IdOffice' => Yii::t('app', 'Id Centro'),
            'IdDeviceType' => Yii::t('app', 'Tipo de dispositivo'),
            'DeviceName' => Yii::t('app', 'Nombre del dispositivo'),
            'DeviceIdentifier' => Yii::t('app', 'Identificador del dispositivo'),
            'AllowAcces' => Yii::t('app', 'Permitir acceso'),
        ];
    }

    /**
    * Gets all sessions created from the current device.
    *
    * @return Sessions(array)|null
    */
    public function getSessions()
    {
        return $this->hasMany(Sessions::className(),['IdDevice' => 'IdDevice']);
    }

    /**
    * Gets device information
    * @param string $name
    *       Name device to be searched
    * @return Devices|null 
    */
    public function findDevice($name)
    {
        return Devices::findOne(['DeviceName' => $name]);
    }

    /**
    * Register the device from login application, if it's not registered
    * @param string $deviceName
    *       Name device to be registered
    * @param string $deviceIP
    *       IP Address device to be registered
    * @param DeviceTypes $deviceType
    *       Type device to be registered
    * @return Devices
    */
    public function registerDevice($deviceName,$deviceIP,$deviceType)
    {
        $device = Devices::findDevice($deviceName.' - '.$deviceIP);

        if($device === null)
        {
            $device = new Devices();
            $device->loadDefaultValues();
            $device->IdDeviceType = $deviceType;
            $device->DeviceName = $deviceName.' - '.$deviceIP;
            $device->DeviceIdentifier = $device->createGuid();
            $device->AllowAcces = true;
            $device->save();
        }
        return $device;
    }
}
