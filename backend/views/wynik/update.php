<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Wynik */

$this->title = 'Popraw wynik: ' . $model->zestaw->nazwa.' dla: '.$model->konto->login;
$this->params['breadcrumbs'][] = ['label' => 'Wynik', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->zestaw->nazwa, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Popraw';
?>
<div class="wynik-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    	'konto' => $konto,
    	'zestaw' => $zestaw,
    ]) ?>

</div>
