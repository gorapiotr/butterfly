<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Konto */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="konto-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'rola_id')->dropdownlist($rola,array('prompt'=>'--- Wybierz z listy ---')) ?>

    <?= $form->field($model, 'imie')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nazwisko')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'login')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'haslo')->textInput(['maxlength' => true]) ?>
    
    <?= $form->field($model, 'archiwum')->dropDownList($archiwum) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Dodaj' : 'Popraw', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
