<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "rola".
 *
 * @property string $id
 * @property string $nazwa
 * @property string $opis
 *
 * @property Konto[] $kontos
 */
class Rola extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'rola';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nazwa', 'opis'], 'required'],
        		[['nazwa'], 'string', 'min'=>2, 'max' => 50],
        		[['nazwa'], 'match', 'pattern' => '/^[A-ZĄĘŻŹĆŁÓŚŃ]{1}[A-ZĄĘŻŹĆŁÓŚŃa-ząężźćłóśń\-]+$/', 'message' => 'Nazwa musi zaczynać się z dużej litery i może zawierać tylko litery i znak minus.'],
            [['opis'], 'string', 'max' => 300],
        		[['opis'], 'match', 'pattern' => '/^[A-ZĄĘŻŹĆŁÓŚŃa-ząężźćłóśń\-_\,\s]+$/', 'message' => 'Opis może zawierać tylko litery, spacje, znak podkreślenia i minus.'],
        		[['archiwum'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nazwa' => 'Nazwa',
            'opis' => 'Opis',
        		'archiwum' => 'Archiwum',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKontos()
    {
        return $this->hasMany(Konto::className(), ['rola_id' => 'id']);
    }
}
