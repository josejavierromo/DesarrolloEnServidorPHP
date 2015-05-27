<?php

namespace app\models\CorePyme\Security\Searchs;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\CorePyme\Security\Companies;

/**
 * CompaniesSearch represents the model behind the search form about `app\models\CorePyme\Security\Companies`.
 */
class CompaniesSearch extends Companies
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['IdCompany'], 'integer'],
            [['TradeName', 'CorporateName', 'CIF', 'Notes'], 'safe'],
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
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Companies::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'IdCompany' => $this->IdCompany,
        ]);

        $query->andFilterWhere(['like', 'TradeName', $this->TradeName])
            ->andFilterWhere(['like', 'CorporateName', $this->CorporateName])
            ->andFilterWhere(['like', 'CIF', $this->CIF])
            ->andFilterWhere(['like', 'Notes', $this->Notes]);

        return $dataProvider;
    }
}
