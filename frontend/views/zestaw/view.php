<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\Zestaw */

$this->title = $model->nazwa;
$this->params['breadcrumbs'][] = ['label' => 'Zestawy słówek', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="zestaw-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Popraw', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Usuń', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Czy jesteś pewien, że chcesz usunąć?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'id',
            'konto.login',
            'jezyk1.nazwa',
            'jezyk2.nazwa',
            'podkategoria.nazwa',
            'nazwa',
            'zestaw:ntext',
            //'ilosc_slowek',
            //'data_dodania',
            //'data_edycji',
        ],
    ]) ?>

</div>
