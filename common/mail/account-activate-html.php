<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $user common\models\User */

$activateLink = Yii::$app->urlManager->createAbsoluteUrl(['site/activate', 'token' => $user->account_activate_token]);
?>
<div class="activate-account">
    <p>Witaj <?= Html::encode($user->login) ?>,</p>

    <p>Przejdź pod wskazany link, aby aktywować konto:</p>

    <p><?= Html::a(Html::encode($activateLink), $activateLink) ?></p>
</div>
