<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\ZestawSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Zestaw';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="zestaw-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Dodaj zestaw', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
    	'options' => ['style' => 'width:100%'],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'konto.login',
            'jezyk1.nazwa',
            'jezyk2.nazwa',
            'podkategoria.nazwa',
            'nazwa',
            'zestaw:ntext',
            'ilosc_slowek',
            'data_dodania',
            'data_edycji',
        		'archiwum:boolean',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
