<?php
/* @var $this yii\web\View */

use yii\bootstrap4\ActiveForm;
use yii\helpers\Html;
use app\models\ColumnSelectForm;

$this->title = 'Продукты';
$this->params['breadcrumbs'][] = $this->title;

$model = new ColumnSelectForm()

?>
<div class="container">
    <div class="row justify-content-center">
        <h1><?= Html::encode($this->title) ?></h1>
    </div>
    <div class="row justify-content-center">
        <div class="col-lg-12">
            <?php $form = ActiveForm::begin(); $form->method = 'get'; ?>
                <div class="row row-cols-lg-5 row-cols-md-4">
                    <?= $form->field($model, 'name')->label('Название')->checkbox(['class' => 'custom-checkbox mr-2']) ?>
                    <?= $form->field($model, 'sku')->label('СКУ')->checkbox(['class' => 'custom-checkbox mr-2']) ?>
                    <?= $form->field($model, 'picture_name')->label('Изображение')->checkbox(['class' => 'custom-checkbox']) ?>
                    <?= $form->field($model, 'type')->label('Тип товара')->checkbox(['class' => 'custom-checkbox', 'property' => 'checked']) ?>
                    <?= $form->field($model, 'amount')->label('Кол-во на склваде')->checkbox(['class' => 'custom-checkbox']) ?>
                    <div class="form-group">
                        <?= Html::submitButton('Показать', ['class' => 'btn btn-primary', 'name' => 'add']) ?>
                    </div>
                </div>
            <?php ActiveForm::end() ?>
        </div>
    </div>
    <?PHP //TODO Добавить таблицу для показа продуктов ?>
</div>