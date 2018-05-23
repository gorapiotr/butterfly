<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\WynikSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Wynik';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="wynik-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Dodaj wynik', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'konto.login',
            'zestaw.nazwa',
            'data_wyniku',
            'wynik',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
