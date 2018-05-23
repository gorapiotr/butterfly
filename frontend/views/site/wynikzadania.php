<?php


/* @var $this yii\web\View */


use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

$breadcrumbs[] = 'Wynik';
$this->params['breadcrumbs'] = $breadcrumbs;

unset($breadcrumbs[4]);
unset($breadcrumbs[3]);
unset($breadcrumbs[2]);

$this->title = 'Słówka';



?>
<div class="site-index">

	 <div class="row">

 <!-- KOLUMNA 1 -->
 	<div class="col-md-6">


  		<h2>Wynik</h2>
  		<p>Sprawdź jak odpowiadałeś:</p>
  		<table class="table">
   		 <thead>
      <tr>
        <th>
        	<?php
        	if($tryb == 0)
        	{
            echo $jezyk1;
        	}
            else
            {
            echo $jezyk2;    
            }
            ?>
        </th>
        <th>
        	<?php
        	if($tryb == 0)
        	{
            echo $jezyk2;
        	}
            else
            {
            echo $jezyk1;    
            }
            ?>
        </th>
        <th>Odpowiedź</th>
      </tr>
    </thead>
    <tbody>  
    <?php 
    for($i =0 ;$i< count($zestaw_slow_jezyk1); $i++)
    {
        if($wektorwyniku[$i] == 1)
        {
            echo '<tr class="success">';
        }
        else
        {
            echo '<tr class="danger">';
        }
        echo '<td>'.$zestaw_slow_jezyk1[$kolejnoscpytan[$i]].'</td>';
        echo '<td>'.$zestaw_slow_jezyk2[$kolejnoscpytan[$i]].'</td>';
        if($wektorwyniku[$i] == 1)
        {
            
            echo '<td><span class="glyphicon glyphicon-ok-sign" aria-hidden="true"></span></td>';
        }
        else
        {
            echo '<td><span class="glyphicon glyphicon-remove-sign" aria-hidden="true"></span></td>';
        }
        
        echo '</tr>';
    }

    ?>
    </tbody>
  </table>
        <div class="<?php echo $procentodp['wyglad'];?>">
            <strong><?php echo $procentodp['tytul'];?></strong>  <?php echo "Procent poprawnych odpowiedzi to: ".$procentodp['procent_odp']."%"; ?>
        </div>

 		<?php

 		$options = ['class' => ['btn btn-md btn-danger'], ];
 		$style = ['style'=>['min-width'=>'300px', 'margin-top'=> '5px', 'margin-right'=> '10px']];
 		
 		echo Html::a('Powrót do trybu nauki: '.$zestaw['nazwa'], ['trybnauki', 'zestawWybrany'=>$zestaw['nazwa'], 'zestawID' => $zestaw['id'],'breadcrumbs'=>$breadcrumbs], $options + $style);

 		?>
	</div>
	   
<!-- KOLUMNA 2 -->   
	   <div class="col-md-4">
	   
	   </div>
 </div>
 
 