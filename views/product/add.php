<?php
/* @var $this yii\web\View */

use yii\bootstrap4\ActiveForm;
use yii\helpers\Html;

$this->title = 'Добавить продукт';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="">
    <h1><?= Html::encode($this->title) ?></h1>
    <div class="row">
        <div class="col-lg-5">
            <?php if (!empty($message) && $message !== 'Success') { ?>
                <div class="alert alert-danger">
                    <?= Html::encode($message) ?>
                </div>
            <?php } ?>
            <?php if (!empty($message) && $message === 'Success') { ?>
                <div class="alert alert-success">
                    <?= Html::encode($message) ?>
                </div>
            <?php } ?>
            <?php $form = ActiveForm::begin(['id' => 'products']); ?>
            <?= $form->field($model, 'name')->textInput(['autofocus' => true])->label('Название') ?>
            <?= $form->field($model, 'picture_name')->fileInput()->label('Изображение') ?>
            <?= $form->field($model, 'sku')->dropdownList([''])->label('SKU') ?>
            <?= $form->field($model, 'amount')->textInput()->label('Кол-во на складе') ?>
            <?= $form->field($model, 'type')->dropdownList([''])->label('Тип') ?>
            <div class="form-group">
                <?= Html::submitButton('Добавить', ['class' => 'btn btn-primary', 'name' => 'add']) ?>
            </div>
            <?php ActiveForm::end(); ?>

        </div>
    </div>
</div>