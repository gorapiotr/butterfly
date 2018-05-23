<?php

/* @var $this yii\web\View */
/* @var $user common\models\User */

$resetLink = Yii::$app->urlManager->createAbsoluteUrl(['site/reset-password', 'token' => $user->password_reset_token]);
?>
Witaj <?= $user->login ?>,

Przejdź pod wskazany link, aby zresetować hasło:

<?= $resetLink ?>
