<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Jezyk */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="jezyk-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nazwa')->textInput(['maxlength' => true]) ?>
	<?= $form->field($model, 'archiwum')->dropDownList($archiwum) ?>
    
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Dodaj' : 'Popraw', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
