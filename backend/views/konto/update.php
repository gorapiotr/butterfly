<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Konto */

$this->title = 'Popraw konto: ' . $model->login;
$this->params['breadcrumbs'][] = ['label' => 'Konto', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->login, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Popraw';
?>
<div class="konto-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    	'rola' => $rola,
    		'archiwum' => $archiwum,
    ]) ?>

</div>
