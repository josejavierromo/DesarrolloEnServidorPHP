<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Usuarios;

/**
 * UsuariosSearch represents the model behind the search form about `app\models\Usuarios`.
 */
class UsuariosSearch extends Usuarios
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Codigo_usuario', 'Telefono_usuario'], 'integer'],
            [['Nombre_usuario', 'Password', 'Email_usuario', 'Direccion'], 'safe'],
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
        $query = Usuarios::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'Codigo_usuario' => $this->Codigo_usuario,
            'Telefono_usuario' => $this->Telefono_usuario,
        ]);

        $query->andFilterWhere(['like', 'Nombre_usuario', $this->Nombre_usuario])
            ->andFilterWhere(['like', 'Password', $this->Contraseña])
            ->andFilterWhere(['like', 'Email_usuario', $this->Email_usuario])
            ->andFilterWhere(['like', 'Direccion', $this->Direccion]);

        return $dataProvider;
    }
}
