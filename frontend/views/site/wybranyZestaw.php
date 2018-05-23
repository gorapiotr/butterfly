<?php

/* @var $this yii\web\View */


use yii\helpers\Html;

$breadcrumbs[] = ['label' => $zestaw_nazwa, 'url' => ['zestaw','zestawWybrany' => $zestaw_nazwa,'zestawID'=>$zestawid,'breadcrumbs'=>$breadcrumbs]];
$this->params['breadcrumbs'] = $breadcrumbs;

$this->title = 'Słówka';
?>
<div class="site-index">

   
    	
    	<div  class="text-left">
        <h3>Wybrany zestaw to: <?php echo $zestaw_nazwa;?> </h3>
        <br>
        <div class="row">
  		<div class="col-md-6">
  		<div class="text-center">
      	<table class="table table-striped">
    		<thead>
      		<tr>
        		<th class="text-center">Język1</th>
        		<th class="text-center">Język2</th>
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
      </div>
      </div>
      </div>