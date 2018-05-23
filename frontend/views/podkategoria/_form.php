<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\Podkategoria */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="podkategoria-form">

    <?php $form = ActiveForm::begin(); ?>

	<?php if(isset($bckategoria_id)) $model->kategoria_id=$bckategoria_id;?>

    <?= $form->field($model, 'kategoria_id')->dropdownlist($kategoria,array('prompt'=>'--- Wybierz z listy ---')) ?>

    <?= $form->field($model, 'nazwa')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'opis')->textarea(['rows' => 6]) ?>

    <!--<?= $form->field($model, 'obrazek')->textInput() ?>-->

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Dodaj' : 'Popraw', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
