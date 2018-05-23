<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\UprawnieniaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Uprawnienia';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="uprawnienia-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Dodaj uprawnienie', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'konto.login',
            'podkategoria.nazwa',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
