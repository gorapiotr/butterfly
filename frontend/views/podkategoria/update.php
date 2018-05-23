<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Podkategoria */

$this->title = 'Popraw podkategorię: ' . $model->nazwa;
$this->params['breadcrumbs'][] = ['label' => 'Podkategoria', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->nazwa, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Popraw';
?>
<div class="podkategoria-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    	'kategoria' => $kategoria,
    ]) ?>

</div>
