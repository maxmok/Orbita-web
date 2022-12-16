<?php

namespace app\models;
use app\models\User;
use Yii;

class UserIdentity extends \yii\base\BaseObject implements \yii\web\IdentityInterface
{
    public $id;
    public $username;
    public $password;
    public $authKey;
    public $accessToken;

    /**
     * Текущий пользователь
     * @var User
     */
    public $user;    
    
    protected static function createIdentity(User $user): UserIdentity {
        $identity = new UserIdentity();
        $identity->id = $user->id;
        $identity->username = $user->login;        
        $identity->user = $user;

        $identity->user->isAdmin = $user->login === 'admin';
        return $identity;
    }


    /**
     * {@inheritdoc}
     */
    public static function findIdentity($id)
    {
        $user = User::findOne($id);
        return $user ? self::createIdentity($user) : null;
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return null;        
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        $user = User::findOne(['login' => $username]);
        return $user ? self::createIdentity($user) : null;
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * {@inheritdoc}
     */
    public function getAuthKey()
    {
        return $this->authKey;
    }

    /**
     * {@inheritdoc}
     */
    public function validateAuthKey($authKey)
    {
        return $this->authKey === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->user->password);        
    }
}
