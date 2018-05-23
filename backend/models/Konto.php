<?php

namespace backend\models;

use Yii;
use yii\web\IdentityInterface;
use yii\base\NotSupportedException;

/**
 * This is the model class for table "konto".
 *
 * @property string $id
 * @property string $rola_id
 * @property string $imie
 * @property string $nazwisko
 * @property string $email
 * @property string $login
 * @property string $haslo
 *
 * @property Rola $rola
 * @property Uprawnienia[] $uprawnienias
 * @property Podkategoria[] $podkategorias
 * @property Wynik[] $wyniks
 * @property Zestaw[] $zestaws
 */
class Konto extends \yii\db\ActiveRecord implements IdentityInterface
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'konto';
    }

    /**
	 * {@inheritDoc}
	 * @see \yii\web\IdentityInterface::findIdentity()
	 */
	public static function findIdentity($id) {
		return static::findOne($id);
		
	}
	
	/**
	 * {@inheritDoc}
	 * @see \yii\web\IdentityInterface::findIdentityByAccessToken()
	 */
	public static function findIdentityByAccessToken($token, $type = null) {
		throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
		
	}

	/**
	 * {@inheritDoc}
	 * @see \yii\web\IdentityInterface::getAuthKey()
	 */
	public function getAuthKey() {
		return $this->id.$this->haslo;
		
	}

	/**
	 * {@inheritDoc}
	 * @see \yii\web\IdentityInterface::getId()
	 */
	public function getId() {
		return $this->id;
		
	}

	/**
	 * {@inheritDoc}
	 * @see \yii\web\IdentityInterface::validateAuthKey()
	 */
	public function validateAuthKey($authKey) {
		return $this->getAuthKey() === $authKey;
		
	}

	public static function findByUsername($username) {
		return self::findOne(['login'=>$username, 'archiwum'=>0, 'status'=>1]);
	}
	
	public function validatePassword($password) {
		return $this->haslo===sha1($password);
	}

	/**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['rola_id', 'imie', 'nazwisko', 'email', 'login', 'haslo'], 'required'],
            [['rola_id'], 'integer'],
        		[['archiwum'], 'integer'],
        		[['imie'], 'string', 'min'=>2,'max' => 20],
        		[['imie'], 'match', 'pattern' => '/^[A-ZĄĘŻŹĆŁÓŚŃ]{1}[a-ząężźćłóśń]+$/', 'message' => 'Imię musi zaczynać się z dużej litery i może zawierać tylko litery.'],
        		[['nazwisko'], 'string', 'min'=>2,'max' => 30],
        		[['nazwisko'], 'match', 'pattern' => '/^[A-ZĄĘŻŹĆŁÓŚŃ]{1}[a-ząężźćłóśń\s]+$/', 'message' => 'Nazwisko musi zaczynać się z dużej litery i może zawierać tylko litery i spacje.'],
        	[['email', 'login', 'haslo'], 'string', 'max' => 50],
        		[['login'], 'match', 'pattern' => '/^[A-ZĄĘŻŹĆŁÓŚŃa-ząężźćłóśń0-9\-_]+$/', 'message' => 'Login może zawierać litery, cyfry znak minus i podkreślenie.'],
        		[['email'],'match', 'pattern' => '/^([a-zA-Z0-9_-]+\.?)+[^\.]@{1}([a-zA-Z0-9-]+\.+)+[a-zA-Z]+$/', 'message' => 'To nie jest prawidłowy adres email.'],		
            [['rola_id'], 'exist', 'skipOnError' => true, 'targetClass' => Rola::className(), 'targetAttribute' => ['rola_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'rola_id' => 'Nazwa roli',
        	'rola.nazwa' => 'Nazwa roli',	
            'imie' => 'Imię',
            'nazwisko' => 'Nazwisko',
            'email' => 'Email',
            'login' => 'Login',
            'haslo' => 'Haslo',
        		'archiwum' => 'Archiwum'
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRola()
    {
        return $this->hasOne(Rola::className(), ['id' => 'rola_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUprawnienias()
    {
        return $this->hasMany(Uprawnienia::className(), ['konto_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPodkategorias()
    {
        return $this->hasMany(Podkategoria::className(), ['id' => 'podkategoria_id'])->viaTable('uprawnienia', ['konto_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWyniks()
    {
        return $this->hasMany(Wynik::className(), ['konto_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getZestaws()
    {
        return $this->hasMany(Zestaw::className(), ['konto_id' => 'id']);
    }
}
