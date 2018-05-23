<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "kategoria".
 *
 * @property string $id
 * @property string $nazwa
 * @property string $opis
 * @property resource $obrazek
 *
 * @property Podkategoria[] $podkategorias
 */
class Kategoria extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'kategoria';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nazwa', 'opis'], 'required'],
        		[['opis', 'obrazek'], 'string', 'max'=> 300],
        		[['archiwum'], 'integer'],
        		[['opis'], 'match', 'pattern' => '/^[A-ZĄĘŻŹĆŁÓŚŃa-ząężźćłóśń\-_\s]+$/', 'message' => 'Opis może zawierać tylko litery, spacje, znak podkreślenia i minus.'],
            [['nazwa'], 'string', 'min'=>2, 'max' => 50],
        		[['nazwa'], 'match', 'pattern' => '/^[A-ZĄĘŻŹĆŁÓŚŃa-ząężźćłóśń\-]+$/', 'message' => 'Nazwa musi zaczynać się z dużej litery i może zawierać tylko litery i znak minus.'],
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
            'obrazek' => 'Obrazek',
        	'archiwum' => 'Archiwum',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPodkategorias()
    {
        return $this->hasMany(Podkategoria::className(), ['kategoria_id' => 'id']);
    }
}
