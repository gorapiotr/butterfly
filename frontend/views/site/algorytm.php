<?php


/* @var $this yii\web\View */

///PROGRESS
$progress = round(($number/$zestaw['ilosc_slowek'])*100);

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

$breadcrumbs[] = 'Nauka';
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
	   	<?php //print_r($zestaw_slow_jezyk1);
	   	      //print_r($kolejnoscpytan)
        ?>
	   	
	   	<br>

 	   <?php $form = ActiveForm::begin()?>
 	   
	   <?= $form->field($model, 'odpowiedz')->textInput(['autofocus' => true, 'autocomplete'=>"off"])?>
	   
	   <div class="form-group">
       <?= Html::submitButton('Dalej', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
       </div>	
	   <?php ActiveForm::end(); ?>

	   </div>
	   
<!-- KOLUMNA 2 -->   
	   <div class="col-md-4">
	   
	   </div>
 </div>
 
 