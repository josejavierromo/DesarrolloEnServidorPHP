<?php

namespace app\models\CorePyme\Security\Searchs;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\CorePyme\Security\Permissions;

/**
 * PermissionsSearch represents the model behind the search form about `app\models\CorePyme\Security\Permissions`.
 */
class PermissionsSearch extends Permissions
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['IdPermission', 'IdSecurityEntity', 'IdSecurityElement', 'View', 'Add', 'Modify', 'Remove', 'Print'], 'integer'],
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
        $query = Permissions::find();

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
            'IdPermission' => $this->IdPermission,
            'IdSecurityEntity' => $this->IdSecurityEntity,
            'IdSecurityElement' => $this->IdSecurityElement,
            'View' => $this->View,
            'Add' => $this->Add,
            'Modify' => $this->Modify,
            'Remove' => $this->Remove,
            'Print' => $this->Print,
        ]);

        return $dataProvider;
    }
}
