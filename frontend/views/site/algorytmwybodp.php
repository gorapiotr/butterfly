<?php


/* @var $this yii\web\View */

///PROGRESS
$progress = round(($number/$zestaw['ilosc_slowek'])*100);

use yii\bootstrap\ActiveForm;
use yii\bootstrap\Button;
use yii\helpers\Html;

if(Yii::$app->cache->get('NUMBER')==0) $breadcrumbs[]='Nauka';
$this->params['breadcrumbs'] = $breadcrumbs;

$this->title = 'Słówka';
?>
<div class="site-index">

	 <div class="row">

 <!-- KOLUMNA 1 -->
 	<div class="col-md-8">
 		<h4> Słówko numer: <?php echo $number; ?> z <?php echo $zestaw['ilosc_slowek'];?></h4>
		<div class="progress">
  			<div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40"
  					aria-valuemin="0" aria-valuemax="100" style='width:<?php echo $progress?>%'>
    			<?php echo $progress;?>%
 			 </div>
		</div>
		
		<br>
		<br>
		<br>
		<h4>Przetłumacz: </h4>
		<div class="panel panel-primary">
		<div class="panel-heading text-center"><b><?php echo $zestaw_slow_jezyk1[$kolejnoscpytan[$number]];?></b> </div></div>
	   	<br>
		<?php 
		$options = ['class' => ['btn btn-md btn-default'], ];
		$style = ['style'=>['min-width'=>'49%', 'margin-top'=> '5px']];
		
		?>
		<div class="container-fluid">
		
	   	<?= Html::a($zestaw_slow_jezyk2[$losoweslowa[0]], ['algorytmwybodp', 'zestawid'=> $zestaw['id'], 'tryb' => 0 , 'odpowiedz'=>$zestaw_slow_jezyk1[$losoweslowa[0]],'jezyk1'=> $jezyk1 ,'jezyk2' => $jezyk2, 'breadcrumbs' => $breadcrumbs], $options + $style);?>
		<?= Html::a($zestaw_slow_jezyk2[$losoweslowa[1]], ['algorytmwybodp', 'zestawid'=> $zestaw['id'], 'tryb' => 0 , 'odpowiedz'=>$zestaw_slow_jezyk1[$losoweslowa[1]],'jezyk1'=> $jezyk1 ,'jezyk2' => $jezyk2, 'breadcrumbs' => $breadcrumbs], $options + $style);?>
		<br>
		<?= Html::a($zestaw_slow_jezyk2[$losoweslowa[2]], ['algorytmwybodp', 'zestawid'=> $zestaw['id'], 'tryb' => 0 , 'odpowiedz'=>$zestaw_slow_jezyk1[$losoweslowa[2]],'jezyk1'=> $jezyk1 ,'jezyk2' => $jezyk2, 'breadcrumbs' => $breadcrumbs], $options + $style);?>
		<?= Html::a($zestaw_slow_jezyk2[$losoweslowa[3]], ['algorytmwybodp', 'zestawid'=> $zestaw['id'], 'tryb' => 0 , 'odpowiedz'=>$zestaw_slow_jezyk1[$losoweslowa[3]],'jezyk1'=> $jezyk1 ,'jezyk2' => $jezyk2, 'breadcrumbs' => $breadcrumbs], $options + $style);?>
		</div>
	   </div>
	   <?php 

	   ?>
	   
<!-- KOLUMNA 2 -->   
	   <div class="col-md-4">
	   
	   </div>
 </div>
 
 