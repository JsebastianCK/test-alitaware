<?php
namespace app\models;

use yii\db\ActiveRecord;

class GrupoUsuario extends ActiveRecord {
    /** 
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'grupoUsuario';
    }

    public function getUsuario()
    {
        return $this->hasOne(Usuario::className(), ['idUsuario' => 'idUsuario']);
    }
}