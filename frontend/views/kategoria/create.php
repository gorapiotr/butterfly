<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\Kategoria */

$this->title = 'Dodaj kategorię';
$this->params['breadcrumbs'][] = ['label' => 'Kategoria', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="kategoria-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
