<?php

/* @var $this yii\web\View */


use yii\helpers\Html;

$this->params['breadcrumbs'][] = $this->title;

$this->title = 'Słówka';
?>
<div class="site-index">

    <div  class="text-left">
	<h2><?= Html::encode('Wybierz kategorię') ?></h2>
	</div>
	
    <?php //print_r($kategorie);
    
$options = ['class' => ['btn btn-lg btn-success'], ];
$style = ['style'=>['min-width'=>'300px', 'margin-top'=> '5px']];

foreach ($kategorie as $kategoria)
{
    //echo '<p><a class="btn btn-lg btn-success" style=" min-width:300px;">'.$kategoria.'</a></p>';
    echo Html::a($kategoria['nazwa'], ['kat', 'kategoria'=> $kategoria['nazwa'], 'id' =>$kategoria['id']], $options + $style);
    echo '</br>';
}

?>
	</br>
	
	<?php 
	if (!yii::$app->user->isGuest && Yii::$app->user->identity->rola->nazwa=='Administrator')
	{
		echo Html::a('Nowa kategoria', ['kategoria/create'], ['class' => 'btn btn-success']); 
	} else echo '<p>Brak uprawnień dla dodawania nowych kategorii.</p>';
	
	?>
	</br>
	</br>
	<?= Html::img('@web/obrazy/butter.png', ['alt' => 'butter','height'=>'150']) ?>
	<span style='font-size: 50px;'>+</span>
	<?= Html::img('@web/obrazy/fly.png', ['alt' => 'fly','height'=>'150']) ?>
	<span style='font-size: 50px;'>=</span>
	<?= Html::img('@web/obrazy/butterfly.png', ['alt' => 'butterfly','height'=>'150']) ?>


</div>

  
