<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\KontoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Konto';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="konto-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Dodaj konto', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

        	'login',
            'rola.nazwa',
            'imie',
            'nazwisko',
            'email:email',
            'haslo',
        		'archiwum:boolean',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
