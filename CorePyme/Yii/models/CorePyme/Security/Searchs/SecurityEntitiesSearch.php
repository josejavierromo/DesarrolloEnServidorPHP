<?php

namespace app\models\CorePyme\Security\Searchs;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\CorePyme\Security\SecurityEntities;

/**
 * SecurityEntitiesSearch represents the model behind the search form about `app\models\CorePyme\Security\SecurityEntities`.
 */
class SecurityEntitiesSearch extends SecurityEntities
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['IdSecurityEntity', 'IdEntityType', 'IdSecurityEntityRelated', 'IdUILanguage', 'IdPrintLanguage', 'Validated'], 'integer'],
            [['Name', 'Description', 'Password', 'AuthKey', 'AccessToken', 'Notes'], 'safe'],
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
    public function search($params,$type)
    {
        $query = SecurityEntities::find()->where(['IdEntityType' => $type]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere(['like', 'Name', $this->Name])
            ->andFilterWhere(['like', 'Description', $this->Description])
            ->andFilterWhere(['like', 'Password', $this->Password])
            ->andFilterWhere(['like', 'AuthKey', $this->AuthKey])
            ->andFilterWhere(['like', 'AccessToken', $this->AccessToken])
            ->andFilterWhere(['like', 'Notes', $this->Notes]);

        return $dataProvider;
    }
}
