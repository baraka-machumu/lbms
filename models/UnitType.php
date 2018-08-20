<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "unit_type".
 *
 * @property int $id
 * @property string $unit_name
 * @property string $cdate
 * @property int $cby
 */
class UnitType extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'unit_type';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['cdate'], 'safe'],
            [['cby'], 'integer'],
            [['unit_name'], 'string', 'max' => 45],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'unit_name' => 'Unit Name',
            'cdate' => 'Cdate',
            'cby' => 'Cby',
        ];
    }
}
