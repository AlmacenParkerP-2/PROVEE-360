<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\RequisicionBienes;

/**
 * RequisicionBienesSearch represents the model behind the search form of `app\models\RequisicionBienes`.
 */
class RequisicionBienesSearch extends RequisicionBienes
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'proveedor_id', 'cantidad'], 'integer'],
            [['fecha_solicitud', 'area_solicitante', 'descripcion_bienes', 'unidad_medida', 'estatus_requisicion'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
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
     * @param string|null $formName Form name to be used into `->load()` method.
     *
     * @return ActiveDataProvider
     */
    public function search($params, $formName = null)
    {
        $query = RequisicionBienes::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params, $formName);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'proveedor_id' => $this->proveedor_id,
            'fecha_solicitud' => $this->fecha_solicitud,
            'cantidad' => $this->cantidad,
        ]);

        $query->andFilterWhere(['like', 'area_solicitante', $this->area_solicitante])
            ->andFilterWhere(['like', 'descripcion_bienes', $this->descripcion_bienes])
            ->andFilterWhere(['like', 'unidad_medida', $this->unidad_medida])
            ->andFilterWhere(['like', 'estatus_requisicion', $this->estatus_requisicion]);

        return $dataProvider;
    }
}
