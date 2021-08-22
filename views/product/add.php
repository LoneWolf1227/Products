<?php
/* @var $this yii\web\View */

use yii\bootstrap4\ActiveForm;
use yii\helpers\Html;

$this->title = 'Добавить продукт';
$this->params['breadcrumbs'][] = $this->title;

if (Yii::$app->session->hasFlash('products')) {
    $flash = Yii::$app->session->getAllFlashes()["products"];
}
if (Yii::$app->session->hasFlash('fileUploadError')) {
    $fileUploadFlash = Yii::$app->session->getAllFlashes()["fileUploadError"];
}

?>
<div class="container">
    <div class="row justify-content-center">
        <h1><?= Html::encode($this->title) ?></h1>
    </div>
    <div class="row justify-content-center">
        <div class="col-lg-5">
            <?php if ((isset($flash) && $flash !== true)) { ?>
                <div class="alert alert-danger">
                    <?= Html::encode($flash) ?>
                </div>
            <?php } ?>
            <?php if ((isset($fileUploadFlash) && $fileUploadFlash !== true)) { ?>
                <div class="alert alert-danger">
                    <?= Html::encode($fileUploadFlash) ?>
                </div>
            <?php } ?>
            <?php if (isset($flash) && $flash === true) { ?>
                <div class="alert alert-success">
                    Продукт успешно добавлено
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