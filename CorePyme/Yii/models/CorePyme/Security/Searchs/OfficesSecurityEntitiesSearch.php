<?php

namespace app\models\CorePyme\Security\Searchs;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\CorePyme\Security\OfficesSecurityEntities;

/**
 * OfficesSecurityEntitiesSearch represents the model behind the search form about `app\models\CorePyme\Security\OfficesSecurityEntities`.
 */
class OfficesSecurityEntitiesSearch extends OfficesSecurityEntities
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['IdOfficeSecurityEntity', 'IdSecurityEntity'], 'integer'],
            [['IdOffice', 'Since'], 'safe'],
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
        $query = OfficesSecurityEntities::find();

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
            'IdOfficeSecurityEntity' => $this->IdOfficeSecurityEntity,
            'IdSecurityEntity' => $this->IdSecurityEntity,
            'Since' => $this->Since,
        ]);

        $query->andFilterWhere(['like', 'IdOffice', $this->IdOffice]);

        return $dataProvider;
    }

    /**
    * Creates data provider instance with search query applied, filtering with login user 
    *
    * @param array $params 
    *
    * @return ActiveDataProvider
    */
    public function searchOfficesUser($params)
    {
        $query = OfficesSecurityEntities::find()->where(['IdSecurityEntity' => Yii::$app->user->identity->IdSecurityEntity]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if(!$this->validate()){
            return $dataProvider;
        }
        return $dataProvider;
    }
}