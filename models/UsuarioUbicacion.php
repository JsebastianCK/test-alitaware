<?php
namespace app\models;

use yii\db\ActiveRecord;

class UsuarioUbicacion extends ActiveRecord {
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'usuarioUbicacion';
    }
}