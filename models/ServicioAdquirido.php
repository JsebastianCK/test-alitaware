<?php
namespace app\models;

use yii\db\ActiveRecord;

class ServicioAdquirido extends ActiveRecord {
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'servicioAdquirido';
    }

    public function getServicio()
    {
        return $this->hasOne(Servicio::className(), ['idServicio' => 'idServicio']);
    }

    public function getUsuario()
    {
        return $this->hasOne(Usuario::className(), ['idUsuario' => 'idUsuario']);
    }

    public function getGrupo()
    {
        return $this->hasOne(Grupo::className(), ['idGrupo' => 'idGrupo']);
    }

    public function obtenerPrecioFinal()
    {
        $precioBase = $this->servicio->price;
        $cantidadEnGrupo = $this->grupo->cantidadusuarios;

        switch($cantidadEnGrupo)
        {
            case $cantidadEnGrupo < 50: return $precioBase;
            case $cantidadEnGrupo < 100: return $precioBase*0.90;
            case $cantidadEnGrupo < 200: return $precioBase*0.80;
            case $cantidadEnGrupo < 300: return $precioBase*0.70;
        }
    }
}