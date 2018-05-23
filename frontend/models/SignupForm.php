<?php
namespace frontend\models;

use yii;
use yii\base\Model;
use common\models\User;
use backend\models\Konto;

/**
 * Signup form
 */
class SignupForm extends Model
{
    public $login;
    public $email;
    public $haslo;
    public $nazwisko;
    public $imie;


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
        		['nazwisko', 'trim'],
        		['nazwisko', 'required'],
        		['nazwisko', 'string', 'min' => 2, 'max' => 50],
        		[['nazwisko'], 'match', 'pattern' => '/^[A-ZĄĘŻŹĆŁÓŚŃ]{1}[a-ząężźćłóśń ]+$/', 'message' => 'Nazwisko musi zaczynać się z dużej litery i może zawierać tylko litery i spacje.'],


        		['imie', 'trim'],
        		['imie', 'required'],
        		['imie', 'string', 'min' => 2, 'max' => 50],
        		[['imie'], 'match', 'pattern' => '/^[A-ZĄĘŻŹĆŁÓŚŃ]{1}[a-ząężźćłóśń]+$/', 'message' => 'Imię musi zaczynać się z dużej litery i może zawierać tylko litery.'],

        	['login', 'trim'],
            ['login', 'required'],
            ['login', 'unique', 'targetClass' => 'backend\models\Konto', 'message' => 'Taki użytkownik istnieje już w bazie.'],
            ['login', 'string', 'min' => 2, 'max' => 50],
        	[['login'], 'match', 'pattern' => '/^[A-ZĄĘŻŹĆŁÓŚŃa-ząężźćłóśń0-9-_]+$/', 'message' => 'Login może zawierać litery, cyfry znak minus i podkreślenie.'],

            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 50],
            ['email', 'unique', 'targetClass' => 'backend\models\Konto', 'message' => 'Taki adres email istnieje już w bazie.'],
        	[['email'],'match', 'pattern' => '/^([a-zA-Z0-9_-]+\.?)+[^\.]@{1}([a-zA-Z0-9-]+\.+)+[a-zA-Z]+$/', 'message' => 'To nie jest prawidłowy adres email.'],



            ['haslo', 'required'],
            ['haslo', 'string', 'min' => 6, 'max' => 50],
        ];
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function signup()
    {
        if (!$this->validate()) {
            return null;
        }

        $user = new Konto;
        $user->nazwisko = $this->nazwisko;
        $user->imie = $this->imie;
        $user->rola_id = 4;
        $user->login = $this->login;
        $user->email = $this->email;
        $user->haslo = sha1($this->haslo);
        $user->account_activate_token = sha1(mt_rand(10000, 99999).time());
        $user->status = 0;
        //$user->generateAuthKey();

        if ($user->save())
        {
            # Aktywacja konta przez email ===========================
            Yii::$app
                ->mailer
                ->compose(
                    ['html' => 'account-activate-html', 'text' => 'account-activate-text'],
                    ['user' => $user]
                )
                ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name . ' robot'])
                ->setTo($this->email)
                ->setSubject('Aktywacja konta na ' . Yii::$app->name)
                ->send();
            // Koniec aktywacji konta przez email ===================
            Yii::$app->session->setFlash('success', 'Odbierz pocztę, aby aktywować konto.');
            return $user;
        } else return null;


    }
}
