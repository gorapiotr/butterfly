<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $user common\models\User */

$resetLink = Yii::$app->urlManager->createAbsoluteUrl(['site/reset-password', 'token' => $user->password_reset_token]);
?>
<div class="password-reset">
    <p>Witaj <?= Html::encode($user->login) ?>,</p>

    <p>Przejdź pod wskazany link, aby zresetować hasło:</p>

    <p><?= Html::a(Html::encode($resetLink), $resetLink) ?></p>
</div>
