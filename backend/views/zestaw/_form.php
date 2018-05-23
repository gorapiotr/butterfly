<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Zestaw */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="zestaw-form">

    <?php $form = ActiveForm::begin(); ?>

	<?php if ($model->isNewRecord) $model->konto_id=Yii::$app->user->id; ?>

    <?= $form->field($model, 'konto_id')->dropdownlist($konto,array('prompt'=>'--- Wybierz z listy ---', 'disabled'=>Yii::$app->user->identity->rola->nazwa=='Administrator' || $model->isNewRecord ? false:true)) ?>

    <?= $form->field($model, 'jezyk1_id')->dropdownlist($jezyk1,array('prompt'=>'--- Wybierz z listy ---')) ?>

    <?= $form->field($model, 'jezyk2_id')->dropdownlist($jezyk2,array('prompt'=>'--- Wybierz z listy ---')) ?>

    <?= $form->field($model, 'podkategoria_id')->dropdownlist($podkategoria,array('prompt'=>'--- Wybierz z listy ---')) ?>

    <?= $form->field($model, 'nazwa')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'zestaw')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'ilosc_slowek')->hiddenInput(['value'=> '0'])->label(false) ?>

    <?= $form->field($model, 'data_dodania')->hiddenInput(['value'=> $model->isNewRecord ? date('Y-m-d') : $model->data_dodania])->label(false) ?>

    <?= $form->field($model, 'data_edycji')->hiddenInput(['value'=> $model->isNewRecord ? '' : date('Y-m-d')])->label(false) ?>
    
    <?= $form->field($model, 'archiwum')->dropDownList($archiwum) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Dodaj' : 'Popraw', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
