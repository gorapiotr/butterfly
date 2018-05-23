<?php

namespace frontend\models;

use Yii;
use yii\base\Model;

class TylkorazForm extends Model
{
    public $odpowiedz;
    
    
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            // name, email, subject and body are required
            [['odpowiedz'], 'required'],
            // email has to be a valid email address
            // verifyCode needs to be entered correctly
            ['verifyCode', 'captcha'],
        ];
    }
}