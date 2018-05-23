<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "wynik".
 *
 * @property string $id
 * @property string $konto_id
 * @property string $zestaw_id
 * @property string $data_wyniku
 * @property integer $wynik
 *
 * @property Zestaw $zestaw
 * @property Konto $konto
 */
class Wynik extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'wynik';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['konto_id', 'zestaw_id', 'data_wyniku', 'wynik'], 'required'],
            [['konto_id', 'zestaw_id', 'wynik'], 'integer'],
        		[['data_wyniku'], 'safe'],
        		[['data_wyniku'], 'date', 'format' => 'yyyy-MM-dd','message' => 'Nieprawidłowy format daty (RRRR-MM-DD).'],
        		[['wynik'], 'integer', 'min'=>0, 'max'=>100],
            [['zestaw_id'], 'exist', 'skipOnError' => true, 'targetClass' => Zestaw::className(), 'targetAttribute' => ['zestaw_id' => 'id']],
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
            'konto_id' => 'Nazwa konta',
            'zestaw_id' => 'Nazwa zestawu',
        	'konto.login' => 'Nazwa konta',
			'zestaw.nazwa' => 'Nazwa zestawu',
            'data_wyniku' => 'Data Wyniku',
            'wynik' => 'Wynik',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getZestaw()
    {
        return $this->hasOne(Zestaw::className(), ['id' => 'zestaw_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKonto()
    {
        return $this->hasOne(Konto::className(), ['id' => 'konto_id']);
    }
}
