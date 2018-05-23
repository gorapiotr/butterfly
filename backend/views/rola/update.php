<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Rola */

$this->title = 'Popraw rolę: ' . $model->nazwa;
$this->params['breadcrumbs'][] = ['label' => 'Rola', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->nazwa, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Popraw';
?>
<div class="rola-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    		'archiwum' => $archiwum,
    ]) ?>

</div>
