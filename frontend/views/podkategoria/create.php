<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\Podkategoria */

$this->title = 'Dodaj podkategorię';
$this->params['breadcrumbs'][] = ['label' => 'Podkategoria', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="podkategoria-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    	'kategoria' => $kategoria,
    	'bckategoria_id' => $bckategoria_id,
    ]) ?>

</div>
