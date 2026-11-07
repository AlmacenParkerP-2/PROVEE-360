<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\EvaluacionProveedor;

/**
 * EvaluacionProveedorSearch represents the model behind the search form of `app\models\EvaluacionProveedor`.
 */
class EvaluacionProveedorSearch extends EvaluacionProveedor
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'proveedor_id', 'criterio_1', 'criterio_2', 'total_puntos'], 'integer'],
            [['fecha', 'comentarios', 'firma_jefe'], 'safe'],
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
        $query = EvaluacionProveedor::find();

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
            'fecha' => $this->fecha,
            'criterio_1' => $this->criterio_1,
            'criterio_2' => $this->criterio_2,
            'total_puntos' => $this->total_puntos,
        ]);

        $query->andFilterWhere(['like', 'comentarios', $this->comentarios])
            ->andFilterWhere(['like', 'firma_jefe', $this->firma_jefe]);

        return $dataProvider;
    }
}
