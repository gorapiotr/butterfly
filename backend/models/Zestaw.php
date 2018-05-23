<?php

namespace backend\models;

use Yii;
use frontend\models\Uprawnienia;

/**
 * This is the model class for table "zestaw".
 *
 * @property string $id
 * @property string $konto_id
 * @property string $jezyk1_id
 * @property string $jezyk2_id
 * @property string $podkategoria_id
 * @property string $nazwa
 * @property string $zestaw
 * @property integer $ilosc_slowek
 * @property string $data_dodania
 * @property string $data_edycji
 *
 * @property Wynik[] $wyniks
 * @property Jezyk $jezyk1
 * @property Jezyk $jezyk2
 * @property Podkategoria $podkategoria
 * @property Konto $konto
 */
class Zestaw extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'zestaw';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['konto_id', 'jezyk1_id', 'jezyk2_id', 'podkategoria_id', 'nazwa', 'zestaw', 'ilosc_slowek', 'data_dodania'], 'required'],
            [['konto_id', 'jezyk1_id', 'jezyk2_id', 'podkategoria_id', 'ilosc_slowek','archiwum'], 'integer'],
            [['zestaw'], 'string'],
            [['data_dodania', 'data_edycji'], 'safe'],
        	[['data_dodania'], 'date', 'format' => 'yyyy-MM-dd','message' => 'Nieprawidłowy format daty (RRRR-MM-DD).'],
        	[['nazwa'], 'string', 'min'=> 2, 'max' => 200],
        	[['nazwa'], 'match', 'pattern' => '/^[A-ZĄĘŻŹĆŁÓŚŃ]{1}[a-ząężźćłóśń\-]+$/', 'message' => 'Nazwa musi zaczynać się z dużej litery i może zawierać tylko litery i znak minus.'],
        	[['zestaw'], 'match', 'pattern' => '/^(([a-ząężźćłóśń]+,?)+[^,];([a-ząężźćłóśń]+,?)+[^,]\s)+$/', 'message' => 'Zestaw musi być utworzony zgodnie z regułami przedstawionymi w pomocy.'],	
            [['jezyk1_id'], 'exist', 'skipOnError' => true, 'targetClass' => Jezyk::className(), 'targetAttribute' => ['jezyk1_id' => 'id']],
            [['jezyk2_id'], 'exist', 'skipOnError' => true, 'targetClass' => Jezyk::className(), 'targetAttribute' => ['jezyk2_id' => 'id']],
            [['podkategoria_id'], 'exist', 'skipOnError' => true, 'targetClass' => Podkategoria::className(), 'targetAttribute' => ['podkategoria_id' => 'id']],
            [['konto_id'], 'exist', 'skipOnError' => true, 'targetClass' => Konto::className(), 'targetAttribute' => ['konto_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'konto_id' => 'Login',
            'jezyk1_id' => 'Język1',
            'jezyk2_id' => 'Język2',
            'podkategoria_id' => 'Nazwa podkategorii',
        	'konto.login' => 'Login',
        	'jezyk1.nazwa' => 'Język 1',
        	'jezyk2.nazwa' => 'Język 2',
        	'podkategoria.nazwa' => 'Nazwa podkategorii',
            'nazwa' => 'Nazwa zestawu',
            'zestaw' => 'Zestaw słówek',
            'ilosc_slowek' => 'Ilosc Slówek',
            'data_dodania' => 'Data dodania',
            'data_edycji' => 'Data edycji',
        	'archiwum' => 'Archiwum',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWyniks()
    {
        return $this->hasMany(Wynik::className(), ['zestaw_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getJezyk1()
    {
        return $this->hasOne(Jezyk::className(), ['id' => 'jezyk1_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getJezyk2()
    {
        return $this->hasOne(Jezyk::className(), ['id' => 'jezyk2_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPodkategoria()
    {
        return $this->hasOne(Podkategoria::className(), ['id' => 'podkategoria_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKonto()
    {
        return $this->hasOne(Konto::className(), ['id' => 'konto_id']);
    }
    
    public function getUprawnienia()
    {
    	return $this->hasOne(Uprawnienia::className(), ['podkategoria_id' => 'podkategoria_id']);
    }
}
