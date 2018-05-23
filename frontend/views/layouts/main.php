<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use yii\widgets\Menu;
use frontend\assets\AppAsset;
use common\widgets\Alert;
use frontend\controllers\SiteController;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => 'System nauki języka Butterfly™',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    $menuItems = [
    	//['label' => 'Zaplecze', 'url' => ['../../../backend/site/index']],
        ['label' => 'Pomoc', 'url' => ['/site/about']],
        //['label' => 'Contact', 'url' => ['/site/contact']],
        //['label' => 'Wyloguj', 'url' =>['/site/wyloguj']],
        
    ];
    if (Yii::$app->user->isGuest) {
        $menuItems[] = ['label' => 'Zarejestruj konto', 'url' => ['/site/signup']];
        $menuItems[] = ['label' => 'Zaloguj', 'url' => ['/site/login']];
    } else {
        $menuItems[] = '<li>'
            . Html::beginForm(['/site/logout'], 'post')
            . Html::submitButton(
                'Wyloguj (' . Yii::$app->user->identity->login . ')',
                ['class' => 'btn btn-link logout']
            )
            . Html::endForm()
            . '</li>';
    }
    
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => $menuItems,
    ]);
    NavBar::end();
    ?>

   <div class="wrap">
  
    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        
        <?php 
        $options = ['class' => ['btn btn-md btn-default text-left'], ];
        $style = ['style'=>['min-width'=>'100%', 'margin-top'=> '2px']];
        
        ?>
        <div class="container">
        	<div class="text-center">
			<div class="col-sm-2">
			<div class="panel panel-success">
      			<div class="panel-heading">Menu</div>
      			<div class="panel-body"><?php echo Html::a('Nauka',['site/index'],$style) ?></div>
      			<?php if(!yii::$app->user->isGuest) { ?>
				<div class="panel-body"><?php echo Html::a('Prywatna nauka', ['site/prywatny'],$style) ?></div>
      			<div class="panel-body"><?php echo Html::a('Wszystkie zestawy',['zestaw/index'],$style) ?></div>
      			<div class="panel-body"><?php echo Html::a('Sprawdź wyniki',['wynik/index'],$style) ?></div>
      			<?php } ?>
    		</div>
    		
    		
    		
			</div>
        <div class="col-sm-10">
        <?= $content ?>
        </div>
        </div>
    </div>
</div>


<div class="navbar navbar-fixed-bottom">
<footer class="footer">
    <div class="container">
    
        <p class="pull-left">&copy; Butterfly Company <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
        
    </div>
</footer>
</div>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
