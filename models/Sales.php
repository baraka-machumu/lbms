<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "sales".
 *
 * @property int $id
 * @property string $details
 * @property string $posting_reference
 * @property string $isdiscount
 * @property double $discount_amount
 * @property string $date
 * @property double $cash
 * @property double $bank
 */
class Sales extends \yii\db\ActiveRecord
{

    public $transactionType;
    public $amount;
    public $price;
    public static function tableName()
    {
        return 'sales';
    }


    public function rules()
    {
        return [
            [['discount_amount', 'cash', 'bank','price','quantity'], 'number'],
            [['date'], 'safe'],
            [['details'], 'string', 'max' => 100],
            [['posting_reference','transactionType'], 'string', 'max' => 10],
            [['isdiscount'], 'string', 'max' => 1],
            [['date', 'cash', 'bank','price','transactionType','details','isdiscount','quantity'], 'required'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'details' => 'Details',
            'posting_reference' => 'Posting Reference',
            'isdiscount' => 'Isdiscount',
            'discount_amount' => 'Discount Amount',
            'date' => 'Date',
            'cash' => 'Cash',
            'bank' => 'Bank',
            'transactionType'=>'Transaction Type',
            'quantity'=>'Quantity',
        ];
    }
}
