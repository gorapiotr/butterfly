<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Jezyk */

$this->title = 'Popraw język: ' . $model->nazwa;
$this->params['breadcrumbs'][] = ['label' => 'Język', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->nazwa, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Popraw';
?>
<div class="jezyk-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    	'archiwum' => $archiwum,
    ]) ?>

</div>
