<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "orders".
 *
 * @property int $id
 * @property int $itemid
 * @property string $order_date
 * @property string $supplier
 * @property string $delivery_date
 * @property string $seller_address
 * @property string $quantity
 * @property string $seller_tel_number
 * @property string $email
 */
class Orders extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'orders';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['itemid'], 'integer'],
            [['order_date', 'delivery_date'], 'safe'],
            [['supplier'], 'string', 'max' => 35],
            [['seller_address', 'quantity', 'seller_tel_number', 'email'], 'string', 'max' => 30],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'itemid' => 'Item Name',
            'order_date' => 'Order Date',
            'supplier' => 'Supplier',
            'delivery_date' => 'Delivery Date',
            'seller_address' => 'Seller Address',
            'quantity' => 'Quantity',
            'seller_tel_number' => 'Seller Telephone Number',
            'email' => 'Email Address',
        ];
    }
}
