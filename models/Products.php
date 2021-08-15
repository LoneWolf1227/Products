<?php

namespace app\models;

use yii\db\ActiveRecord;

/**
 * This is the model class for table "products".
 *
 * @property int $id
 * @property string $picture_name
 * @property string $sku
 * @property string $name
 * @property string $amount
 * @property string $type
 */
class Products extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName(): string
    {
        return 'products';
    }

    /**
     * {@inheritdoc}
     */
    public function rules(): array
    {
        return [
            [['picture_name', 'sku', 'name'], 'required'],
            [['picture_name', 'sku', 'type'], 'string', 'max' => 255],
            [['name'], 'string', 'max' => 70],
            [['amount'], 'string', 'max' => 13],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels(): array
    {
        return [
            'id' => 'ID',
            'picture_name' => 'Picture name',
            'sku' => 'Sku',
            'name' => 'Name',
            'amount' => 'Amount',
            'type' => 'Type',
        ];
    }

    public function deleteProducts($ids)
    {
        Products::deleteAll(['and', 'id' => $this->id], ['in', 'id', $ids]);
    }

}
