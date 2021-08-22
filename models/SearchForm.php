<?php

namespace app\models;

use yii\base\Model;

class SearchForm extends Model
{
    public $q;
    /**
     * {@inheritdoc}
     */
    public function rules(): array
    {
        return [
            [['q'], 'string', 'max' => 255],
        ];
    }

}
