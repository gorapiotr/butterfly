<?php
namespace frontend\controllers;

use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use frontend\models\Kategoria;
use frontend\models\PasswordResetRequestForm;
use frontend\models\Podkategoria;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;
use frontend\models\Zestaw;
use frontend\models\Jezyk;
use frontend\controllers\SiteController;


class Mojefunkcje
{
    public function zestaw_slow_jezyk1($zestaw)
    {
        /// ROZDZIELANIE ZESTAWU NA JEZYKI
        $zestaw_slow = explode(" ", trim((string)$zestaw['zestaw']));
        
        $zestaw_slow_jezyk1 =array();
        
        for($i=0; $i<count($zestaw_slow);$i++)
        {
        	$zmienna= explode(";", trim((string)$zestaw_slow[$i]));
            array_push($zestaw_slow_jezyk1, $zmienna[0]);
        }
        
        return $zestaw_slow_jezyk1;
    }
    
    public function zestaw_slow_jezyk2($zestaw)
    {
        /// ROZDZIELANIE ZESTAWU NA JEZYKI
        $zestaw_slow = explode(" ", trim((string)$zestaw['zestaw']));
        
        $zestaw_slow_jezyk2 =array();
        
        for($i=0; $i<count($zestaw_slow);$i++)
        {
        	$zmienna= explode(";", trim((string)$zestaw_slow[$i]));
            array_push($zestaw_slow_jezyk2, $zmienna[1]);
        }
        
        return $zestaw_slow_jezyk2;
    }
}