<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\PodkategoriaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Podkategoria';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="podkategoria-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Dodaj podkategorię', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'nazwa',
        	'kategoria.nazwa',
        	'opis:ntext',
            'obrazek',
        		'archiwum:boolean',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
