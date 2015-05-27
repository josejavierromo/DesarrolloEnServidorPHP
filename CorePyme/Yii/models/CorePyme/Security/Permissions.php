<?php

namespace app\models\CorePyme\Security;

use Yii;
use app\models\CorePyme\Security\SecurityEntities;
use app\models\CorePyme\Security\SecurityElement;
/**
 * This is the model class for table "Permissions".
 *
 * @property integer $IdPermission
 * @property integer $IdSecurityEntity
 * @property integer $IdSecurityElement
 * @property integer $View
 * @property integer $Add
 * @property integer $Modify
 * @property integer $Remove
 * @property integer $Print
 */
class Permissions extends \app\models\Common\Record
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Permissions';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['IdSecurityEntity', 'IdSecurityElement', 'View', 'Add', 'Modify', 'Remove', 'Print'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'IdPermission' => Yii::t('app', 'Id Permission'),
            'IdSecurityEntity' => Yii::t('app', 'Usuario'),
            'IdSecurityElement' => Yii::t('app', 'Elemento de seguridad'),
            'View' => Yii::t('app', 'Ver'),
            'Add' => Yii::t('app', 'Añadir'),
            'Modify' => Yii::t('app', 'Modificar'),
            'Remove' => Yii::t('app', 'Eliminar'),
            'Print' => Yii::t('app', 'Imprimir'),
        ];
    }


    public function getSecurityEntity()
    {
        return $this->hasOne(SecurityEntities::className(),['IdSecurityEntity' => 'IdSecurityEntity']);
    }

    public function getSecurityElement()
    {
        return $this->hasOne(SecurityElements::className(), ['IdSecurityElement' => 'IdSecurityElement']);
    }

    public function existPermission($idSecurtiyEntity, $IdSecurityElement)
    {
        return Permissions::findOne(['IdSecurityEntity' => $idSecurtiyEntity,
                                     'IdSecurityElement' => $IdSecurityElement]);
    }

}
