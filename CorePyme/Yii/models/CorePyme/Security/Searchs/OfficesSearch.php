<?php

namespace app\models\CorePyme\Security\Searchs;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\CorePyme\Security\Offices;

/**
 * OfficesSearch represents the model behind the search form about `app\models\CorePyme\Security\Offices`.
 */
class OfficesSearch extends Offices
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['IdOffice', 'OfficeAlias', 'OfficeName', 'OffcieTradeName', 'CIF', 'OfficeCode', 'Colour'], 'safe'],
            [['IdCompany'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
    * Creates data provider instance with search query applied
    * @param array $params
    *
    * @return ActiveDataProvider
    */
    public function search($idCompany)
    {
        $query = Offices::find()->where(['IdCompany' => $idCompany]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to any records when validation fails
            //$query->where('0=1');
            return $dataProvider;
        }

        return $dataProvider;
    }
}
