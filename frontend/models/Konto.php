<?php

namespace frontend\models;

use Yii;

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
class Konto extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'konto';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['rola_id', 'imie', 'nazwisko', 'email', 'login', 'haslo'], 'required'],
            [['rola_id'], 'integer'],
            [['imie'], 'string', 'max' => 20],
            [['nazwisko'], 'string', 'max' => 30],
            [['email', 'login', 'haslo'], 'string', 'max' => 50],
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
            'rola_id' => 'Rola ID',
            'imie' => 'Imie',
            'nazwisko' => 'Nazwisko',
            'email' => 'Email',
            'login' => 'Login',
            'haslo' => 'Haslo',
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

    public function generatePasswordResetToken()
    {
        $this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    public static function findByPasswordResetToken($token)
    {
        if (!static::isPasswordResetTokenValid($token)) {
            return null;
        }

        return static::findOne([
            'password_reset_token' => $token,
            'status' => 1,
        ]);
    }

    public static function isPasswordResetTokenValid($token)
    {
        if (empty($token)) {
            return false;
        }

        $timestamp = (int) substr($token, strrpos($token, '_') + 1);
        $expire = Yii::$app->params['user.passwordResetTokenExpire'];
        return $timestamp + $expire >= time();
    }

    public function setPassword($password)
    {
        $this->haslo = sha1($password);
    }

    public function removePasswordResetToken()
    {
        $this->password_reset_token = null;
    }
}
