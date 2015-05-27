<?php

namespace app\models\CorePyme\Security;

use Yii;
use yii\db\Query;
use app\models\CorePyme\Security\Permissions;

/**
 * This is the model class for table "SecurityElements".
 *
 * @property integer $IdSecurityElement
 * @property integer $IdSecurityElementRelated
 * @property integer $IdModule
 * @property string $SecurityElementCode
 * @property string $SecurityElement
 * @property integer $AllowAdd
 * @property integer $AllowModify
 * @property integer $AllowRemove
 * @property integer $AllowPrint
 * @property integer $AllowView
 * @property string $Notes
 */
class SecurityElements extends \app\models\Common\Record
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'SecurityElements';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['IdSecurityElementRelated', 'IdModule', 'AllowAdd', 'AllowModify', 'AllowRemove', 'AllowPrint', 'AllowView'], 'integer'],
            [['SecurityElementCode'], 'string', 'max' => 20],
            [['SecurityElement'], 'string', 'max' => 25],
            [['Notes'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'IdSecurityElement' => Yii::t('app', 'Id Security Element'),
            'IdSecurityElementRelated' => Yii::t('app', 'Id Security Element Related'),
            'IdModule' => Yii::t('app', 'Id Module'),
            'SecurityElementCode' => Yii::t('app', 'Security Element Code'),
            'SecurityElement' => Yii::t('app', 'Security Element'),
            'AllowAdd' => Yii::t('app', 'Allow Add'),
            'AllowModify' => Yii::t('app', 'Allow Modify'),
            'AllowRemove' => Yii::t('app', 'Allow Remove'),
            'AllowPrint' => Yii::t('app', 'Allow Print'),
            'AllowView' => Yii::t('app', 'Allow View'),
            'Notes' => Yii::t('app', 'Notes'),
        ];
    }

    public function getPermissions()
    {
        return $this->hasMany(Permissions::className(), ['IdSecurityElement' => 'IdSecurityElement']);
    }


    public function getAllSecurityElements()
    {
        return SecurityElements::find();
    }

}
