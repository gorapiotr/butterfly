<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Rejestracja';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-signup">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Wypełnij poniższe pola, aby się zarejestrować:</p>

    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>

                <?= $form->field($model, 'nazwisko')->textInput(['autofocus' => true])->label('Nazwisko') ?>

                <?= $form->field($model, 'imie')->textInput(['autofocus' => true])->label('Imię') ?>

                <?= $form->field($model, 'login')->textInput(['autofocus' => true])->label('Nazwa użytkownika') ?>

                <?= $form->field($model, 'email')->label('Adres e-mail') ?>

                <?= $form->field($model, 'haslo')->passwordInput()->label('Hasło') ?>

                <div class="form-group">
                    <?= Html::submitButton('Zarejestruj', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
                </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
