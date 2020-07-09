<?php
namespace app\models;

use yii\db\ActiveRecord;

class Grupo extends ActiveRecord {
    public static function primaryKey()
    {
        return array('idGrupo');
    }

    /** 
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'grupo';
    }

    /**
     * Devuelve los servicios que
     * pertenecen al grupo
     * @return Servicio[]
     */
    public function getServicios()
    {
        $servicios = [];

        foreach($this->serviciosadquiridos as $servicioAdquirido) {
            array_push($servicios, $servicioAdquirido->servicio);
        }

        return $servicios;
    }

    /**
     * Devuelve los servicios adquiridos por el grupo
     * @return ServicioAdquirido[]
     */
    public function getServiciosadquiridos()
    {
        return $this->hasMany(ServicioAdquirido::className(), ['idGrupo' => 'idGrupo']);
    }

    /**
     * Devuelve todos los usuarios pertenecientes al Grupo
     * 
     * @return Usuario[] Usuarios del grupo
     */
    public function getUsuarios()
    {
        $usuarios = [];

        foreach($this->grupousuarios as $grupoUsuario) {
            array_push($usuarios, $grupoUsuario->usuario);
        }

        return $usuarios;
    }

    /**
     * Devuelve la cantidad de usuarios pertencientes al grupo
     * @return int Cantidad de usuarios
     */
    public function getCantidadusuarios()
    {
        return count($this->grupousuarios);
    }

    /**
     * Devuelve los GrupoUsuario del grupo
     * @return GrupoUsuario[]
     */
    public function getGrupousuarios()
    {
        return $this->hasMany(GrupoUsuario::className(), ['idGrupo' => 'idGrupo']);
    }

    public function attributeLabels()
    {
        return [
            'idGrupo' => 'ID Grupo',
            'name' => 'Name'
        ];
    }
}