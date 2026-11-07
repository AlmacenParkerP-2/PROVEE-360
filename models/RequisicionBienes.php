<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "requisicion_bienes".
 *
 * @property int $id
 * @property int $proveedor_id
 * @property string $fecha_solicitud
 * @property string $area_solicitante
 * @property string $descripcion_bienes
 * @property int $cantidad
 * @property string $unidad_medida
 * @property string|null $estatus_requisicion
 *
 * @property Proveedor $proveedor
 */
class RequisicionBienes extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'requisicion_bienes';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['estatus_requisicion'], 'default', 'value' => 'Solicitado'],
            [['proveedor_id', 'fecha_solicitud', 'area_solicitante', 'descripcion_bienes', 'cantidad', 'unidad_medida'], 'required'],
            [['proveedor_id', 'cantidad'], 'integer'],
            [['fecha_solicitud'], 'safe'],
            [['descripcion_bienes'], 'string'],
            [['area_solicitante'], 'string', 'max' => 150],
            [['unidad_medida', 'estatus_requisicion'], 'string', 'max' => 50],
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
            'fecha_solicitud' => 'Fecha Solicitud',
            'area_solicitante' => 'Area Solicitante',
            'descripcion_bienes' => 'Descripcion Bienes',
            'cantidad' => 'Cantidad',
            'unidad_medida' => 'Unidad Medida',
            'estatus_requisicion' => 'Estatus Requisicion',
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
