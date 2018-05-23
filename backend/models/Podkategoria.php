<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "podkategoria".
 *
 * @property string $id
 * @property string $kategoria_id
 * @property string $nazwa
 * @property string $opis
 * @property resource $obrazek
 *
 * @property Kategoria $kategoria
 * @property Uprawnienia[] $uprawnienias
 * @property Konto[] $kontos
 * @property Zestaw[] $zestaws
 */
class Podkategoria extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'podkategoria';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['kategoria_id', 'nazwa', 'opis'], 'required'],
            [['kategoria_id','archiwum'], 'integer'],
            [['opis', 'obrazek'], 'string', 'max'=> 300],
        		[['opis'], 'match', 'pattern' => '/^[A-ZĄĘŻŹĆŁÓŚŃa-ząężźćłóśń\-_\s]+$/', 'message' => 'Opis może zawierać tylko litery, spacje, znak podkreślenia i minus.'],
        		[['nazwa'], 'string', 'min'=>2, 'max' => 50],
        		[['nazwa'], 'match', 'pattern' => '/^[A-ZĄĘŻŹĆŁÓŚŃ]{1}[a-ząężźćłóśń\-]+$/', 'message' => 'Nazwa musi zaczynać się z dużej litery i może zawierać tylko litery i znak minus.'],
            [['kategoria_id'], 'exist', 'skipOnError' => true, 'targetClass' => Kategoria::className(), 'targetAttribute' => ['kategoria_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'kategoria_id' => 'Nazwa kategorii',
            'kategoria.nazwa' => 'Nazwa kategorii',
        	'nazwa' => 'Nazwa podkategorii',
            'opis' => 'Opis',
            'obrazek' => 'Obrazek',
        		'archiwum' => 'Archiwum'
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKategoria()
    {
        return $this->hasOne(Kategoria::className(), ['id' => 'kategoria_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUprawnienias()
    {
        return $this->hasMany(Uprawnienia::className(), ['podkategoria_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKontos()
    {
        return $this->hasMany(Konto::className(), ['id' => 'konto_id'])->viaTable('uprawnienia', ['podkategoria_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getZestaws()
    {
        return $this->hasMany(Zestaw::className(), ['podkategoria_id' => 'id']);
    }
}
