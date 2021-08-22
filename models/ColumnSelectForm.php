<?php

namespace app\models;

use yii\base\Model;

class ColumnSelectForm extends Model
{
    public $picture_name = 1;
    public $name = 1;
    public $sku = 1;
    public $type = 1;
    public $amount = 1;
    /**
     * {@inheritdoc}
     */
    public function rules(): array
    {
        return [
            [['name', 'sku', 'picture_name', 'type', 'amount'], 'string'],
        ];
    }

}
