<?php

/* @var $this yii\web\View */
/* @var $user common\models\User */

$activateLink = Yii::$app->urlManager->createAbsoluteUrl(['site/activate', 'token' => $user->account_activate_token]);
?>
Witaj <?= $user->login ?>,

Przejdź pod wskazany link, aby aktywować konto:

<?= $activateLink ?>
