<?php

/* @var $this yii\web\View */
/* @var $model frontend\models\Zestaw */

use yii\helpers\Html;

$this->params['breadcrumbs'][] = ['label' => $bckategoria, 'url' => ['kat','kategoria' => $bckategoria,'id'=>$bckategoria_id]];
$this->params['breadcrumbs'][] = ['label' => $podkategoria, 'url' => ['podkat','podkategoria'=>$podkategoria,'id'=>$bcpodkategoria_id,'bckategoria' => $bckategoria,'bckategoria_id'=>$bckategoria_id]];
$breadcrumbs = $this->params['breadcrumbs'];

$this->title = 'Słówka';
?>
<div class="site-index">

   
    	
    	<div  class="text-left">
        <h3>Zestawy z podkategorii: <?php echo $podkategoria?></h3>
        </div>
        <?php 
        
        $options = ['class' => ['btn btn-lg btn-danger'], ];
        $style = ['style'=>['min-width'=>'300px', 'margin-top'=> '5px', 'margin-right'=> '10px', 'disabled'=>'disabled']];
        
        
        $options_button = ['class' => ['btn btn-lg btn-info'], ];
        $style_button = ['style'=>['min-width'=>'200px', 'margin-top'=> '5px', 'margin-left'=>'5px']];
        
        foreach ($zestawy as $zestaw)
        {
            
            echo Html::a($zestaw['nazwa'], ['zestaw', 'zestawWybrany'=>$zestaw['nazwa'], 'zestawID' => $zestaw['id'], 'breadcrumbs' => $breadcrumbs], $options + $style);
            echo Html::a('tryb nauki', ['trybnauki', 'zestawWybrany'=>$zestaw['nazwa'], 'zestawID' => $zestaw['id'], 'breadcrumbs' => $breadcrumbs], $options_button + $style_button);
            echo Html::a('tryb sprawdzania wiedzy', ['trybsprawdzaniawiedzy', 'zestawWybrany'=>$zestaw['nazwa'], 'zestawID' => $zestaw['id'], 'breadcrumbs' => $breadcrumbs], $options_button + $style_button);
            echo '</br>';
        }
      
        
        ?>
       
       	</br>
	<?php 
	// Sprawdzanie czy użytkownik może dodawać nowe zestawy
	if (!yii::$app->user->isGuest && 
		(in_array(Yii::$app->user->identity->rola->nazwa,['Administrator','Redaktor','SuperRedaktor','Użytkownik']) && isset($uprawnienia)
		|| in_array(Yii::$app->user->identity->rola->nazwa,['Administrator'])))
	{ 
		echo Html::a('Nowy zestaw', ['zestaw/create','bcpodkategoria_id'=>$bcpodkategoria_id], ['class' => 'btn btn-success']);
	} else echo '<p>Brak uprawnień do tworzenia zestawów w tej podkategorii.</p>';
	?>
	
</div>

  
