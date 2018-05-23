<?php

use yii\helpers\Html;
use yii\grid\GridView;
use miloschuman\highcharts\Highcharts;
use backend\models\Wynik;
use backend\models\Zestaw;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\WynikSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Wyniki sprawdzania wiedzy';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="wynik-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?php //echo Html::a('Dodaj wynik', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    
    <?php 

    $zestaw= zestaw::find()
    -> where(['wynik.konto_id'=>Yii::$app->user->getid()])
    -> joinwith('wyniks')
    -> orderby('data_wyniku')
    -> all();
    
    $kategorie = [];

    foreach($zestaw as $dane)
    {
    	$wyniki_kategorii = [];    	

		$wynik= wynik::find()
		-> andwhere(['konto_id'=>Yii::$app->user->getid()])
		-> andwhere(['zestaw_id'=>$dane['id']])
		-> orderby('data_wyniku')
		-> all();
    	
		foreach ($wynik as $pole)
		{
			$wyniki_kategorii[]= $pole['wynik'];
		}
		
    	$kategorie[]=['name'=>$dane['nazwa'],'data'=>$wyniki_kategorii];
    	
    } 
    ?>  
    
	<?=Highcharts::widget([
   	  'options' => [
      'title' => ['text' => 'Postępy nauki'],
      'xAxis' => [
         'categories' => []
      ],
      'yAxis' => [
         'title' => ['text' => '% poprawnych odpowiedzi']
      ],
   	  		'series' => $kategorie]
	]); 
	?>   

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
