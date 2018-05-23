<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\Wynik */

$this->title = 'Popraw wynik';
$this->params['breadcrumbs'][] = ['label' => 'Wynik', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="wynik-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    	'konto' => $konto,
    	'zestaw' => $zestaw,
    ]) ?>

</div>
