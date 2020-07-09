<?php
namespace app\models;

use yii\db\ActiveRecord;

class Servicio extends ActiveRecord {
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'servicio';
    }
}