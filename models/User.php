<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "db_user".
 *
 * @property int $id
 * @property string $login
 * @property string $password
 * 
 */
class user extends \yii\db\ActiveRecord
{
    public $pasword;
    public $isAdmin = false;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'db_user';
    }

    public function beforeValidate() {
        if($this->password) {
            $this->password_hash = Yii::$app->security->generatePasswordHash($this->password);            
        }
        return parent::beforeValidate();
    }

    /**
     * {@inheritdoc}
     */

    public function rules()
    {
        return [
            [['login', 'password'], 'required'],
            [['login'], 'string', 'max' => 100],
            [['password'], 'string', 'max' => 500],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'login' => 'Логин',
            'password' => 'Пароль',
        ];
    }
    
}
