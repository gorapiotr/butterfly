<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Wynik */

$this->title = 'Wyniki:'. $model->zestaw->nazwa.' dla: '.$model->konto->login;
$this->params['breadcrumbs'][] = ['label' => 'Wynik', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="wynik-view">

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
            'konto.login',
            'zestaw.nazwa',
            'data_wyniku',
            'wynik',
        ],
    ]) ?>

</div>
