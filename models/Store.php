<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "store".
 *
 * @property int $id
 * @property string $item_name
 * @property int $unit_price
 * @property int $purchasing_price
 * @property int $unit_type
 * @property int $cby
 * @property string $cdate
 */
class Store extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'store';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['unit_price', 'purchasing_price', 'unit_type','quantity','item_name'], 'required'],
            [['unit_price', 'purchasing_price', 'unit_type', 'cby'], 'integer'],
            [['cdate'], 'safe'],
            [['item_name'], 'string', 'max' => 45],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'item_name' => 'Item Name',
            'unit_price' => 'Unit Price',
            'purchasing_price' => 'Purchasing Price',
            'unit_type' => 'Unit Type',
            'cby' => 'Cby',
            'cdate' => 'Date',
            'quantity'=>'Quantity'
        ];
    }
}
