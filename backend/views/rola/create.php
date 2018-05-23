<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Rola */

$this->title = 'Popraw rolę';
$this->params['breadcrumbs'][] = ['label' => 'Rola', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rola-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    		'archiwum' => $archiwum,
    ]) ?>

</div>
