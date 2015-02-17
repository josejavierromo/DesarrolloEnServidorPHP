<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Eventos;

/**
 * EventosSearch represents the model behind the search form about `app\models\Eventos`.
 */
class EventosSearch extends Eventos
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Codigo_evento', 'Telefono_evento', 'Numero_usuarios', 'Cod_usuario'], 'integer'],
            [['Nombre_evento', 'Email_evento', 'Direccion_evento', 'Descripcion_evento', 'Logo', 'Portada', 'Fecha_creacion', 'Fecha_inicio', 'Fecha_fin'], 'safe'],
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
        $query = Eventos::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'Codigo_evento' => $this->Codigo_evento,
            'Telefono_evento' => $this->Telefono_evento,
            'Fecha_creacion' => $this->Fecha_creacion,
            'Fecha_inicio' => $this->Fecha_inicio,
            'Fecha_fin' => $this->Fecha_fin,
            'Numero_usuarios' => $this->Numero_usuarios,
            'Cod_usuario' => $this->Cod_usuario,
        ]);

        $query->andFilterWhere(['like', 'Nombre_evento', $this->Nombre_evento])
            ->andFilterWhere(['like', 'Email_evento', $this->Email_evento])
            ->andFilterWhere(['like', 'Direccion_evento', $this->Direccion_evento])
            ->andFilterWhere(['like', 'Descripcion_evento', $this->Descripcion_evento])
            ->andFilterWhere(['like', 'Logo', $this->Logo])
            ->andFilterWhere(['like', 'Portada', $this->Portada]);

        return $dataProvider;
    }
}
