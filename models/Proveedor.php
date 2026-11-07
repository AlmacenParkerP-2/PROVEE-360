<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "proveedor".
 *
 * @property int $id
 * @property string $nombre_empresa
 * @property string $domicilio
 * @property string $ciudad
 * @property string $telefono
 * @property string $correo_electronico
 * @property string $propietario_legal
 * @property string $rfc
 * @property string|null $estatus
 * @property string|null $created_at
 *
 * @property EvaluacionProveedor[] $evaluacionProveedors
 * @property SeleccionProveedor[] $seleccionProveedors
 */
class Proveedor extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'proveedor';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['estatus'], 'default', 'value' => 'Pendiente'],
            [['nombre_empresa', 'domicilio', 'ciudad', 'telefono', 'correo_electronico', 'propietario_legal', 'rfc'], 'required'],
            [['created_at'], 'safe'],
            [['nombre_empresa', 'domicilio', 'propietario_legal'], 'string', 'max' => 255],
            [['ciudad'], 'string', 'max' => 100],
            [['telefono'], 'string', 'max' => 20],
            [['correo_electronico'], 'string', 'max' => 150],
            [['rfc'], 'string', 'max' => 13],
            [['estatus'], 'string', 'max' => 50],
            [['rfc'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nombre_empresa' => 'Nombre Empresa',
            'domicilio' => 'Domicilio',
            'ciudad' => 'Ciudad',
            'telefono' => 'Telefono',
            'correo_electronico' => 'Correo Electronico',
            'propietario_legal' => 'Propietario Legal',
            'rfc' => 'Rfc',
            'estatus' => 'Estatus',
            'created_at' => 'Created At',
        ];
    }

    /**
     * Gets query for [[EvaluacionProveedors]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEvaluacionProveedors()
    {
        return $this->hasMany(EvaluacionProveedor::class, ['proveedor_id' => 'id']);
    }

    /**
     * Gets query for [[SeleccionProveedors]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSeleccionProveedors()
    {
        return $this->hasMany(SeleccionProveedor::class, ['proveedor_id' => 'id']);
    }

}
