<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "seleccion_proveedor".
 *
 * @property int $id
 * @property int $proveedor_id
 * @property string $fecha
 * @property int $criterio_1
 * @property int $criterio_2
 * @property int $criterio_3
 * @property int $criterio_4
 * @property int $criterio_5
 * @property int $criterio_6
 * @property int $criterio_7
 * @property int $criterio_8
 * @property int $total_puntos
 * @property string|null $comentarios
 * @property string|null $firma_jefe
 *
 * @property Proveedor $proveedor
 */
class SeleccionProveedor extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'seleccion_proveedor';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['comentarios', 'firma_jefe'], 'default', 'value' => null],
            [['proveedor_id', 'fecha', 'criterio_1', 'criterio_2', 'criterio_3', 'criterio_4', 'criterio_5', 'criterio_6', 'criterio_7', 'criterio_8', 'total_puntos'], 'required'],
            [['proveedor_id', 'criterio_1', 'criterio_2', 'criterio_3', 'criterio_4', 'criterio_5', 'criterio_6', 'criterio_7', 'criterio_8', 'total_puntos'], 'integer'],
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
            'criterio_3' => 'Criterio 3',
            'criterio_4' => 'Criterio 4',
            'criterio_5' => 'Criterio 5',
            'criterio_6' => 'Criterio 6',
            'criterio_7' => 'Criterio 7',
            'criterio_8' => 'Criterio 8',
            'total_puntos' => 'Total Puntos',
            'comentarios' => 'Comentarios',
            'firma_jefe' => 'Firma Jefe',
        ];
    }

    /**
     * Gets query for [[Proveedor]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProveedor()
    {
        return $this->hasOne(Proveedor::class, ['id' => 'proveedor_id']);
    }

}
