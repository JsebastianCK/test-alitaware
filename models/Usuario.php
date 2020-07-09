<?php
namespace app\models;

use yii\db\ActiveRecord;

class Usuario extends ActiveRecord {
    public static function primaryKey()
    {
        return array('idUsuario');
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'usuario';
    }

    public function getNombreCompleto()
    {
        return "{$this->surname}, {$this->name}";
    }
    
    public function getUbicaciones()
    {
        return $this->hasMany(UsuarioUbicacion::className(), ['idUsuario' => 'idUsuario'])->orderBy(['date' => SORT_DESC]);
    }

    public function getUltimaubicacion()
    {
        return ($this->ubicaciones) ? $this->ubicaciones[0] : null;
    }

    public function attributeLabels()
    {
        return [
            'idUsuario' => 'ID Usuario'
        ];
    }
}