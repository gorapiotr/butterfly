<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Uprawnienia */

$this->title = 'Popraw uprawnienie: ' .$model->podkategoria->nazwa.' dla: '.$model->konto->login;
$this->params['breadcrumbs'][] = ['label' => 'Uprawnienia', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->podkategoria->nazwa, 'url' => ['view', 'konto_id' => $model->konto_id, 'podkategoria_id' => $model->podkategoria_id]];
$this->params['breadcrumbs'][] = 'Popraw';
?>
<div class="uprawnienia-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    	'konto' => $konto,
    	'podkategoria' => $podkategoria,
    ]) ?>

</div>
