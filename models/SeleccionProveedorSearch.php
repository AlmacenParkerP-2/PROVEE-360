<?php

namespace app\models;

use Yii;

/**
 * Este es el modelo para la tabla "seleccion_proveedor".
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
 * @property int $total_puntos
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
            // Criterios obligatorios que el usuario selecciona en pantalla
            [['proveedor_id', 'fecha', 'criterio_1', 'criterio_2', 'criterio_3', 'criterio_4', 'criterio_5', 'criterio_6', 'criterio_7'], 'required', 'message' => 'Este campo es obligatorio.'],
            
            // Tipos de datos permitidos
            [['proveedor_id', 'criterio_1', 'criterio_2', 'criterio_3', 'criterio_4', 'criterio_5', 'criterio_6', 'criterio_7', 'total_puntos'], 'integer'],
            [['fecha'], 'safe'],
            
            // Permitir que total_puntos pase limpio ya que lo calculamos por código
            [['total_puntos'], 'safe'],
            
            // Relación con la tabla de Proveedores
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
            'proveedor_id' => 'Proveedor',
            'fecha' => 'Fecha',
            'criterio_1' => 'Criterio 1',
            'criterio_2' => 'Criterio 2',
            'criterio_3' => 'Criterio 3',
            'criterio_4' => 'Criterio 4',
            'criterio_5' => 'Criterio 5',
            'criterio_6' => 'Criterio 6',
            'criterio_7' => 'Criterio 7',
            'total_puntos' => 'Total Puntos',
        ];
    }

    /**
     * Obtiene la relación con el Proveedor.
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProveedor()
    {
        return $this->hasOne(Proveedor::class, ['id' => 'proveedor_id']);
    }
}
