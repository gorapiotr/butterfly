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
use frontend\controllers\Mojefunkcje;
use frontend\models\TylkorazForm;
use frontend\models\AlgorytmWybOdpForm;
use frontend\models\Wynik;
use frontend\models\Konto;
use frontend\models\Uprawnienia;
/**
 * Site controller
 */




class SiteController extends Controller
{
   
   
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        
        $kategorie = Kategoria::find()
        -> where('kategoria.nazwa<>"Prywatne" and kategoria.id<>5')
        -> andwhere(['archiwum'=>0])
        -> orderBy('opis')
        -> all();
        
       // $kategorie = ["Jeden", "Dwa", "Trzy", "Cztery"];
        return $this->render('index', ['kategorie' => $kategorie]);
    }

    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return mixed
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            } else {
                Yii::$app->session->setFlash('error', 'There was an error sending your message.');
            }

            return $this->refresh();
        } else {
            return $this->render('contact', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Displays about page.
     *
     * @return mixed
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionSignup()
    {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                #if (Yii::$app->getUser()->login($user)) {
                    return $this->goHome();
                #}
            }
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Aby zresetować hasło, odbierz swoją pocztę.');

                return $this->goHome();
            } else {
                Yii::$app->session->setFlash('error', 'Przepraszamy, nie możemy zresetować hasła dla podanego adresu email.');
            }
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'Hasło zostało zmienione.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }
    
    public function actionKat($kategoria, $id)
    {
       $podkategorie = Podkategoria::find()
       ->where(['kategoria_id' => $id])
       -> andwhere(['archiwum'=>0])
       -> orderBy('id')
       -> all();
       
       return $this->render('podkategorie', [
       		'kategoria' => $kategoria,
       		'podkategorie' => $podkategorie, 
       		'bckategoria_id' => $id,        		
       ]);
    }
    
    public function actionPodkat($podkategoria, $id, $bckategoria, $bckategoria_id)
    {
        $zestawy = Zestaw::find()
        ->where(['podkategoria_id' => $id])
        -> andwhere(['archiwum'=>0])
        -> orderBy('id')
        -> all();
        
        // Sprawdzanie czy nadano uprawnienia dla dodawania zestawów do podkategorii
        $uprawnienia = Uprawnienia::find()
        ->where(['konto_id' => Yii::$app->user->getid()])
        ->andwhere(['podkategoria_id' => $id])
        -> one();
        
        return $this->render('zestaw',[
        		'zestawy' => $zestawy, 
        		'podkategoria'=>$podkategoria, 
        		'bckategoria' => $bckategoria, 
        		'bckategoria_id' => $bckategoria_id, 
        		'bcpodkategoria_id'=> $id,
        		'uprawnienia' => $uprawnienia,
        ]);
    }
    
    public function actionPrywatny()
    {
    	$zestawy = Zestaw::find()
    	-> where(['podkategoria_id' => 9]) // Prywatna podkategoria
    	-> andwhere(['konto_id' => Yii::$app->user->getid()]) // Wybieranie tylko prywatnych zestawów
    	-> andwhere(['archiwum'=>0])
    	-> orderBy('id')
    	-> all();
    	   	    	
    	return $this->render('zestawprywatny',[
    			'zestawy' => $zestawy,
    			'podkategoria'=> 'PRYWATNE ZESTAWY',
    			'bckategoria' => 'Prywatne',
    			'bckategoria_id' => 5,
    			'bcpodkategoria_id'=> 9,
    			'uprawnienia' => '',
    	]);
    }
    
    

    public function actionZestaw($zestawWybrany, $zestawID, array $breadcrumbs)
    {
        
        ///SZUKANIE ZESTAWU
        $zestaw = Zestaw::find()
        ->where(['id' => $zestawID])
        -> one();

        $funkcja = new Mojefunkcje();
        $zestaw_slow_jezyk1 = $funkcja -> zestaw_slow_jezyk1($zestaw);
        $zestaw_slow_jezyk2 = $funkcja -> zestaw_slow_jezyk2($zestaw);
        
             
        return $this->render('wybranyZestaw', ['zestaw_nazwa' => $zestawWybrany, 'zestaw' => $zestaw, 'zestawid' => $zestawID,
             'zestaw_slow_jezyk1'=> $zestaw_slow_jezyk1, 'zestaw_slow_jezyk2'=> $zestaw_slow_jezyk2, 'breadcrumbs'=> $breadcrumbs]);
    }
    
    public function actionTrybnauki($zestawWybrany, $zestawID, array $breadcrumbs)
    {
        ///SZUKANIE ZESTAWU
        $zestaw = Zestaw::find()
        ->where(['id' => $zestawID])
        -> one();
        
        
        
        $funkcja = new Mojefunkcje();
        $zestaw_slow_jezyk1 = $funkcja -> zestaw_slow_jezyk1($zestaw);
        $zestaw_slow_jezyk2 = $funkcja -> zestaw_slow_jezyk2($zestaw);
        
        ///POBIERANIE JEZYKA
        $jezyk1 = Jezyk::find()
        ->where(['id' => $zestaw['jezyk1_id']])
        ->one();
        
        $jezyk2 = Jezyk::find()
        ->where(['id' => $zestaw['jezyk2_id']])
        ->one();
        
        
        ////INICJALIZACJA ZMIENNYCH W CACHE
        Yii::$app->cache->set('ALG1_GEN', TRUE);
        
        
        return $this->render('trybnauki', ['zestaw' => $zestaw, 'zestaw_nazwa' => $zestawWybrany, 'zestawid' => $zestawID, 'jezyk1' => $jezyk1['nazwa'],
            'jezyk2' => $jezyk2['nazwa'], 'zestaw_slow_jezyk1'=> $zestaw_slow_jezyk1, 
        		'zestaw_slow_jezyk2'=> $zestaw_slow_jezyk2, 'breadcrumbs'=> $breadcrumbs]);
    }
    
    public function actionTrybsprawdzaniawiedzy($zestawWybrany, $zestawID, array $breadcrumbs)
    {
        ///SZUKANIE ZESTAWU
        $zestaw = Zestaw::find()
        ->where(['id' => $zestawID])
        -> one();
        
        
        
        $funkcja = new Mojefunkcje();
        $zestaw_slow_jezyk1 = $funkcja -> zestaw_slow_jezyk1($zestaw);
        $zestaw_slow_jezyk2 = $funkcja -> zestaw_slow_jezyk2($zestaw);
        
        ///POBIERANIE JEZYKA
        $jezyk1 = Jezyk::find()
        ->where(['id' => $zestaw['jezyk1_id']])
        ->one();
        
        $jezyk2 = Jezyk::find()
        ->where(['id' => $zestaw['jezyk2_id']])
        ->one();
        
        
        ////INICJALIZACJA ZMIENNYCH W CACHE
        Yii::$app->cache->set('ALG1_GEN', TRUE);
        if (!Yii::$app->user->id) Yii::$app->session->setFlash('success', 'Aby zapisywać swoje postępy nauki, zarejestruj się i zaloguj.');

        return $this->render('trybsprawdzaniawiedzy', ['zestaw' => $zestaw, 'zestaw_nazwa' => $zestawWybrany, 'zestawid' => $zestawID, 'jezyk1' => $jezyk1['nazwa'],
            'jezyk2' => $jezyk2['nazwa'], 'zestaw_slow_jezyk1'=> $zestaw_slow_jezyk1,
        		'zestaw_slow_jezyk2'=> $zestaw_slow_jezyk2, 'breadcrumbs'=> $breadcrumbs]);
    }
    
    
    

    
    public function actionAlgorytm($zestawid, $jezyk1, $jezyk2, $tryb, $alg, array $breadcrumbs, $SprawdzanieWiedzy=NULL)
    {
        ///SZUKANIE ZESTAWU
        $zestaw = Zestaw::find()
        ->where(['id' => $zestawid])
        -> one();
        
        ///MIESZANIE PYTAŃ
        ///WYKONUJE SIE TYLKO RAZ USTALAJAC KOLEJNOSC
        
        if(Yii::$app->cache->get('ALG1_GEN')== TRUE)
        {
            $kolejnoscpytan = range(0, $zestaw['ilosc_slowek']-1);
            shuffle($kolejnoscpytan);
        
            ///KOLEJNOSC
            Yii::$app->cache->set('KOLEJNOSC', $kolejnoscpytan);
            ///NUMER PYTANIA
            Yii::$app->cache->set('NUMBER', 0);
            ///UZYSKANY WYNIK
            Yii::$app->cache->set('WYNIK', array());
           
            
            Yii::$app->cache->set('ALG1_GEN', FALSE);
        }
        
        
        
        $kolejnoscpytan=Yii::$app->cache->get('KOLEJNOSC');
        $number=Yii::$app->cache->get('NUMBER');
        
        $funkcja = new Mojefunkcje();
        if($tryb == 0)
        {
        $zestaw_slow_jezyk1 = $funkcja -> zestaw_slow_jezyk1($zestaw);
        $zestaw_slow_jezyk2 = $funkcja -> zestaw_slow_jezyk2($zestaw);
        }
        else
        {
            $zestaw_slow_jezyk2 = $funkcja -> zestaw_slow_jezyk1($zestaw);
            $zestaw_slow_jezyk1 = $funkcja -> zestaw_slow_jezyk2($zestaw); 
        }

        ///FORM
        $model = new TylkorazForm();
        
        if ($model->load(Yii::$app->request->post())) 
        {
            if($alg== 0 )            
            {
                // Uwzględnianie wariantów odpowiedzi
            	if(in_array($model['odpowiedz'],explode(",", $zestaw_slow_jezyk2[$kolejnoscpytan[$number]])))
            	  {   
                   ///ZAPISYWANIE DO WEKTORA ODPOWIEDZI 
                   $macierz =Yii::$app->cache->get('WYNIK');
                   array_push($macierz, '1');
                   Yii::$app->cache->set('WYNIK',$macierz);
                   
                    echo '<script>alert("Gratulacje poprawna odpowiedź!")</script>';
                   }
               else
                   {
                   ///ZAPISYWANIE DO WEKTORA ODPOWIEDZI 
                   $macierz =Yii::$app->cache->get('WYNIK');
                   array_push($macierz, '0');
                   Yii::$app->cache->set('WYNIK',$macierz);
                     
                    echo '<script>alert("Niestety odpowiedz błędna!")</script>';
             }
             
             
             ///DODANIE LICZNIKA ABY ZMIENILO SIE PYTANIE
             Yii::$app->cache->set('NUMBER', Yii::$app->cache->get('NUMBER')+1);
             $number = Yii::$app->cache->get('NUMBER');
        }
            
            if($alg==1)
            {
            	// Uwzględnianie wariantów odpowiedzi
                if(in_array($model['odpowiedz'],explode(",", $zestaw_slow_jezyk2[$kolejnoscpytan[$number]])))
                    {
                    ///ZAPISYWANIE DO WEKTORA ODPOWIEDZI
                    $macierz =Yii::$app->cache->get('WYNIK');
                    array_push($macierz, '1');
                    Yii::$app->cache->set('WYNIK',$macierz);
                    
                    echo '<script>alert("Gratulacje poprawna odpowiedź!")</script>';
                    ///DODANIE LICZNIKA ABY ZMIENILO SIE PYTANIE
                    Yii::$app->cache->set('NUMBER', Yii::$app->cache->get('NUMBER')+1);
                    $number = Yii::$app->cache->get('NUMBER');
                    }
                else
                    {
                    echo '<script>alert("Spróbuj jeszcze raz!")</script>';
                    }
            }
        }     

           
           if($number == $zestaw['ilosc_slowek'])
           {
         	
	           	// Zapisanie wyniku w bazie jesli zalogowany użytkownik
	           	if (Yii::$app->user->id && !empty($SprawdzanieWiedzy))
	           	{
	           		$dobre_odpowiedzi=0;
	           		$liczba_odpowiedzi=0;
	           		// Zliczanie wyników
	           		foreach (Yii::$app->cache->get('WYNIK') as $wyniki)
	           		{
	           			if ($wyniki==1) $dobre_odpowiedzi++;
	           			$liczba_odpowiedzi++;
	           		}
	           		$wynik_zapis = new Wynik;
	           		$wynik_zapis->konto_id= Yii::$app->user->id;
	           		$wynik_zapis->zestaw_id=$zestawid;
	           		$wynik_zapis->data_wyniku=date('Y-m-d');
	           		$wynik_zapis->wynik=round(($dobre_odpowiedzi/$liczba_odpowiedzi)*100);
	           		$wynik_zapis->save();
	           	} else
                {
                    Yii::$app->session->setFlash('error', 'Aby zapisywać swoje postępy nauki, zarejestruj się i zaloguj.');
                }
           	
               return $this->render('wynikzadania', ['wektorwyniku'=> Yii::$app->cache->get('WYNIK') ,
                   'zestaw_slow_jezyk2'=>$zestaw_slow_jezyk2, 'zestaw_slow_jezyk1'=>$zestaw_slow_jezyk1,
                   'kolejnoscpytan' => $kolejnoscpytan,'zestaw' =>$zestaw,  'jezyk1' => $jezyk1,
                   'jezyk2' => $jezyk2, 'tryb' => $tryb, 'breadcrumbs' => $breadcrumbs, 'procentodp' => $this->ProcentOdpowiedzi(Yii::$app->cache->get('WYNIK'))
               ]);
           }
        
 		$model->odpowiedz='';
        return $this->render('algorytm', ['kolejnoscpytan' => $kolejnoscpytan, 'zestaw' => $zestaw, 
            'zestaw_slow_jezyk1'=> $zestaw_slow_jezyk1, 'zestaw_slow_jezyk2'=> $zestaw_slow_jezyk2,
        		'number'=>$number, 'model' => $model, 'breadcrumbs'=> $breadcrumbs
        ]);
    }
   
    public function actionAlgorytmwybodp($zestawid, $tryb ,$odpowiedz, $jezyk1, $jezyk2, array $breadcrumbs)
    {
        ///SZUKANIE ZESTAWU
        $zestaw = Zestaw::find()
        ->where(['id' => $zestawid])
        -> one();
        
        ///MIESZANIE PYTAŃ
        ///WYKONUJE SIE TYLKO RAZ USTALAJAC KOLEJNOSC
        
        if(Yii::$app->cache->get('ALG1_GEN')== TRUE)
        {
            $kolejnoscpytan = range(0, $zestaw['ilosc_slowek']-1);
            shuffle($kolejnoscpytan);
            
            ///KOLEJNOSC
            Yii::$app->cache->set('KOLEJNOSC', $kolejnoscpytan);
            ///NUMER PYTANIA
            Yii::$app->cache->set('NUMBER', 0);
            ///UZYSKANY WYNIK
            Yii::$app->cache->set('WYNIK', array());
            
            
            Yii::$app->cache->set('ALG1_GEN', FALSE);
        }
        $kolejnoscpytan=Yii::$app->cache->get('KOLEJNOSC');
       
        
        $funkcja = new Mojefunkcje();
        if($tryb == 0)
        {
            $zestaw_slow_jezyk1 = $funkcja -> zestaw_slow_jezyk1($zestaw);
            $zestaw_slow_jezyk2 = $funkcja -> zestaw_slow_jezyk2($zestaw);
        }
        else
        {
            $zestaw_slow_jezyk2 = $funkcja -> zestaw_slow_jezyk1($zestaw);
            $zestaw_slow_jezyk1 = $funkcja -> zestaw_slow_jezyk2($zestaw);
        }
        
        $kolejnoscpytan=Yii::$app->cache->get('KOLEJNOSC');
        $number=Yii::$app->cache->get('NUMBER');
        
        if($odpowiedz !=(string)0)
        {
            if($odpowiedz ==$zestaw_slow_jezyk1[$kolejnoscpytan[$number]] )
            {
                
                ///ZAPISYWANIE DO WEKTORA ODPOWIEDZI
                $macierz =Yii::$app->cache->get('WYNIK');
                array_push($macierz, '1');
                Yii::$app->cache->set('WYNIK',$macierz);
                echo '<script>alert("Poprawna odpowiedź");</script>';
            }
            else
            {
                ///ZAPISYWANIE DO WEKTORA ODPOWIEDZI
                $macierz =Yii::$app->cache->get('WYNIK');
                array_push($macierz, '0');
                Yii::$app->cache->set('WYNIK',$macierz);
                echo '<script>alert("Odpowiedź błędna");</script>';
            }
                       
               
            
        ///INKREMENTACJA LICZNIKA
        Yii::$app->cache->set('NUMBER', Yii::$app->cache->get('NUMBER')+1);
        $number = Yii::$app->cache->get('NUMBER');
        
        if($number == $zestaw['ilosc_slowek'])
        {
        	
            return $this->render('wynikzadania', ['wektorwyniku'=> Yii::$app->cache->get('WYNIK') ,
                'zestaw_slow_jezyk2'=>$zestaw_slow_jezyk2, 'zestaw_slow_jezyk1'=>$zestaw_slow_jezyk1,
                'kolejnoscpytan' => $kolejnoscpytan,'zestaw' =>$zestaw,  'jezyk1' => $jezyk1,
            		'jezyk2' => $jezyk2, 'tryb' => $tryb, 'breadcrumbs' => $breadcrumbs,  'procentodp' => $this->ProcentOdpowiedzi(Yii::$app->cache->get('WYNIK'))

            ]);
        }
        }
        
        ///GENEROWANIE LOSOWYCH 3 PYTAN
        $losoweslowa1 = range(0, $zestaw['ilosc_slowek']-1);
        $number=Yii::$app->cache->get('NUMBER');
        $find = $kolejnoscpytan[$number];
        $key = array_search( $find, $losoweslowa1 );
        unset($losoweslowa1[$key]);
        shuffle($losoweslowa1);
        $losoweslowa = array();
        array_push($losoweslowa, $losoweslowa1[0]);
        array_push($losoweslowa, $losoweslowa1[1]);
        array_push($losoweslowa, $losoweslowa1[2]);
        array_push($losoweslowa, $kolejnoscpytan[$number]);
        shuffle($losoweslowa);
        return $this->render('algorytmwybodp', ['kolejnoscpytan' => $kolejnoscpytan, 'zestaw' => $zestaw,
            'zestaw_slow_jezyk1'=> $zestaw_slow_jezyk1, 'zestaw_slow_jezyk2'=> $zestaw_slow_jezyk2,
            'number'=>$number, 'losoweslowa' => $losoweslowa, 'jezyk1' => $jezyk1,
            'jezyk2' => $jezyk2, 'breadcrumbs' => $breadcrumbs
        ]);
    }
    
    public function PostepyNauki()
    {
    	echo '<div class="progress">';
    	echo '<div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40"';
    			echo 'aria-valuemin="0" aria-valuemax="100" style="width:40%">';
    			
 			 echo '</div>';
 		echo '</div>';
    }
    
    public function test()
    {
        echo 'działa';
    }

    public function ProcentOdpowiedzi(array $wektorodpowiedzi)
    {

        $procentodp["procent_odp"] = round(array_sum($wektorodpowiedzi)/count($wektorodpowiedzi)*100, 0);
        if($procentodp["procent_odp"]>60)
        {
            $procentodp['tytul']="Gratulację";
            $procentodp['wyglad']="alert alert-success";
        }
        else
        {
            $procentodp['tytul']="Nie jest dobrze";
            $procentodp['wyglad']="alert alert-danger";

        }

        return $procentodp ;
    }

    public function actionActivate($token)
    {
        $model= Konto::findOne([
            'status' => 0,
            'archiwum' => 0,
            'account_activate_token' => $token,
            ]);
        if ($model === null) {
            Yii::$app->session->setFlash('error', 'Nieprawidłowy token aktywacyjny.');
            return $this->goHome();
        }
        else
        {
            $model->status = 1;
            $model->account_activate_token = null;
            if ($model->save()) Yii::$app->session->setFlash('success', 'Konto zostało aktywowane.');
            return $this->goHome();
        }
    }
}
