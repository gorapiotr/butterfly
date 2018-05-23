<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Rola */

$this->title = $model->nazwa;
$this->params['breadcrumbs'][] = ['label' => 'Rola', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rola-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Popraw', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Usuń', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Czy jesteś pewny, że chcesz usunąć?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'nazwa',
            'opis',
        		'archiwum:boolean',
        ],
    ]) ?>

</div>
