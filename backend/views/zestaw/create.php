<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Zestaw */

$this->title = 'Dodaj zestaw';
$this->params['breadcrumbs'][] = ['label' => 'Zestaw', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="zestaw-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    	'konto' => $konto,
    	'jezyk1' => $jezyk1,
    	'jezyk2' => $jezyk2,
    	'podkategoria' => $podkategoria,
    		'archiwum' => $archiwum,
    ]) ?>

</div>
