<?php

/* @var $this yii\web\View */


use yii\helpers\Html;

$breadcrumbs[] = ['label' => 'Tryb nauki', 'url' => ['trybnauki','zestawWybrany' => $zestaw_nazwa,'zestawID'=>$zestawid,'breadcrumbs'=>$breadcrumbs]];
$this->params['breadcrumbs'] = $breadcrumbs;

$this->title = 'Słówka';
?>
<div class="site-index">

   
    	
    	<div  class="text-left">
		<h2>
		<?php 
		echo $zestaw['nazwa'];
		?>
		</h2>
        </div>
	

 
 <div class="row">
 <!-- KOLUMNA 1 -->
 	<div class="col-md-5">
 	<br>
 	<div class="panel panel-primary">
 	<div class="panel-heading text-center">Bank słówek</div>
 	</div>
 		<div class="text-center">
      		<table class="table table-striped">
    			<thead>
      				<tr>
        				<th class="text-center"><?php echo $jezyk1 ?></th>
        				<th class="text-center"><?php echo $jezyk2 ?></th>
      				</tr>
    			</thead>
    					<tbody>
      				<?php 
      	             for($i=0; $i<count($zestaw_slow_jezyk1);$i++)
      	             {
      	              echo '<tr>';
      	              echo '<td>';
      	              echo $zestaw_slow_jezyk1[$i];
      	              echo '</td>';
      	              echo '<td>';
      	              echo $zestaw_slow_jezyk2[$i];
      	              echo '</td>';
      	              echo '</tr>';
      	             }
      	             ?> 
   						</tbody>
    		</table>    	 
      </div>  
 </div>
 <!-- KOLUMNA 2 -->
<div class="col-md-1">
</div>
 <!-- KOLUMNA 3 -->
 	<div class="col-md-5">
 		<br>
		<div class="panel panel-primary">
		<div class="panel-heading"><?php echo $jezyk1.'&nbsp<span class="glyphicon glyphicon-arrow-right" 
                                                             aria-hidden="true"></span> '.$jezyk2; ?></div>
		</div>
		<?php 
		///Styl przyciskow
		$options = ['class' => ['btn btn-md btn-default text-left'], ];
		$style = ['style'=>['min-width'=>'300px', 'margin-top'=> '5px']];
		
		///Przyciski 1
		echo Html::a('Pytaj tylko raz', ['algorytm', 'zestawid'=> $zestaw['id'], 'jezyk1'=> $jezyk1 ,'jezyk2' => $jezyk2, 'tryb' => 0 , 'alg' =>0, 'breadcrumbs' => $breadcrumbs], $options + $style);
		echo Html::a('Pytaj do skutku', ['algorytm', 'zestawid'=> $zestaw['id'], 'jezyk1'=> $jezyk1 ,'jezyk2' => $jezyk2, 'tryb' => 0 , 'alg' =>1, 'breadcrumbs' => $breadcrumbs], $options + $style);
		
		// Jesli ilosc pytań w zestawie jest mniejsza od 4 to nie pozwala przeprowadzić nauki
		if ($zestaw['ilosc_slowek']>=4)
		{
			echo Html::a('Wybierz odpowiedź', ['algorytmwybodp', 'zestawid'=> $zestaw['id'], 'tryb' => 0 , 'odpowiedz'=>0,'jezyk1'=> $jezyk1 ,'jezyk2' => $jezyk2, 'breadcrumbs' => $breadcrumbs], $options + $style);
		} 
		else echo Html::button('Wybierz odpowiedź', [ 'class' => 'btn btn-md btn-default text-left','style'=>'min-width:300px;margin-top:5px', 'onclick' => 'alert("Zbyt mało pytań w zestawie dla tego tryby nauki. Minimalna ilość to 4.");' ]);
		
		?>
		<br>
 		<br>
 		<div class="panel panel-primary">
		<div class="panel-heading"><?php echo $jezyk2.'&nbsp<span class="glyphicon glyphicon-arrow-right" 
                                                             aria-hidden="true"></span> '.$jezyk1; ?></div>
		</div>
		<?php 
		///Przyciski 1
		echo Html::a('Pytaj tylko raz', ['algorytm', 'zestawid'=> $zestaw['id'], 'jezyk1'=> $jezyk1 ,'jezyk2' => $jezyk2,'tryb' => 1, 'alg' =>0, 'breadcrumbs' => $breadcrumbs], $options + $style);
		echo Html::a('Pytaj do skutku', ['algorytm', 'zestawid'=> $zestaw['id'], 'jezyk1'=> $jezyk1 ,'jezyk2' => $jezyk2,'tryb' => 1, 'alg' =>1, 'breadcrumbs' => $breadcrumbs], $options + $style);

		// Jesli ilosc pytań w zestawie jest mniejsza od 4 to nie pozwala przeprowadzić nauki
		if ($zestaw['ilosc_slowek']>=4)
		{
			echo Html::a('Wybierz odpowiedź', ['algorytmwybodp', 'zestawid'=> $zestaw['id'], 'tryb' => 0 , 'odpowiedz'=>0,'jezyk1'=> $jezyk1 ,'jezyk2' => $jezyk2, 'breadcrumbs' => $breadcrumbs], $options + $style);
		}
		else echo Html::button('Wybierz odpowiedź', [ 'class' => 'btn btn-md btn-default text-left','style'=>'min-width:300px;margin-top:5px', 'onclick' => 'alert("Zbyt mało pytań w zestawie dla tego tryby nauki. Minimalna ilość to 4.");' ]);
		
		?>

 		<br>
 	</div>
 </div>
 
 
</div>