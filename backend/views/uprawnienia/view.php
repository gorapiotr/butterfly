<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Uprawnienia */

$this->title = 'Uprawnienie: '.$model->podkategoria->nazwa.' dla: '.$model->konto->login;
$this->params['breadcrumbs'][] = ['label' => 'Uprawnienia', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="uprawnienia-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Popraw', ['update', 'konto_id' => $model->konto_id, 'podkategoria_id' => $model->podkategoria_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Usuń', ['delete', 'konto_id' => $model->konto_id, 'podkategoria_id' => $model->podkategoria_id], [
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
            'konto.login',
            'podkategoria.nazwa',
        ],
    ]) ?>

</div>
