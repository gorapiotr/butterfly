<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Uprawnienia */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="uprawnienia-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'konto_id')->dropdownlist($konto,array('prompt'=>'--- Wybierz z listy ---')) ?>

    <?= $form->field($model, 'podkategoria_id')->dropdownlist($podkategoria,array('prompt'=>'--- Wybierz z listy ---')) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Dodaj' : 'Popraw', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
