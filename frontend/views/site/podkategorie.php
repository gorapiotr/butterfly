<?php

/* @var $this yii\web\View */


use yii\helpers\Html;

$this->params['breadcrumbs'][] = ['label' => $kategoria, 'url' => ['kat','kategoria'=>$kategoria,'id'=>$bckategoria_id]];

$this->title = 'Słówka';
?>
<div class="site-index">

   
    	
    	<div  class="text-left">
        <h3>Wybierz podkategorię z kategorii: <?php echo $kategoria ?></h3>
        </div>
        
        <?php 
        
        $options = ['class' => ['btn btn-lg btn-danger'], ];
        $style = ['style'=>['min-width'=>'300px', 'margin-top'=> '5px']];
        
        foreach ($podkategorie as $podkategoria)
        {
            //echo '<p><a class="btn btn-lg btn-success" style=" min-width:300px;">'.$podkategoria.'</a></p>';
            echo Html::a($podkategoria['nazwa'], ['podkat', 'podkategoria'=> $podkategoria['nazwa'], 
            'id'=> $podkategoria['id'], 'bckategoria'=>$kategoria, 'bckategoria_id'=>$bckategoria_id], $options + $style);
            echo '</br>';
        }
        
        ?>
		
		</br>
	<?php 
	if (!yii::$app->user->isGuest && Yii::$app->user->identity->rola->nazwa=='Administrator')
	{
		echo Html::a('Nowa podkategoria', ['podkategoria/create', 'bckategoria_id' => $bckategoria_id], ['class' => 'btn btn-success']);
	} else echo '<p>Brak uprawnień dla dodawania nowych podkategorii.</p>';
	?>
</div>

  
