<?php

namespace app\models;

use Yii;

/**
 * Este es el modelo para la tabla "evaluacion_proveedor".
 *
 * @property int $id
 * @property int $proveedor_id
 * @property string $fecha
 * @property int $criterio_1
 * @property int $criterio_2
 * @property int $total_puntos
 * @property string|null $comentarios
 * @property string|null $firma_jefe
 *
 * @property Proveedor $proveedor
 */
class EvaluacionProveedor extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'evaluacion_proveedor';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['proveedor_id', 'fecha', 'criterio_1', 'criterio_2'], 'required', 'message' => 'Este campo es obligatorio.'],
            [['proveedor_id', 'criterio_1', 'criterio_2', 'total_puntos'], 'integer'],
            [['fecha'], 'safe'],
            [['comentarios'], 'string'],
            [['firma_jefe'], 'string', 'max' => 255],
            [['proveedor_id'], 'exist', 'skipOnError' => true, 'targetClass' => Proveedor::class, 'targetAttribute' => ['proveedor_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'proveedor_id' => 'Proveedor ID',
            'fecha' => 'Fecha',
            'criterio_1' => 'Criterio 1',
            'criterio_2' => 'Criterio 2',
            'total_puntos' => 'Total Puntos',
            'comentarios' => 'Comentarios',
            'firma_jefe' => 'Firma Jefe',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProveedor()
    {
        return $this->hasOne(Proveedor::class, ['id' => 'proveedor_id']);
    }
}
