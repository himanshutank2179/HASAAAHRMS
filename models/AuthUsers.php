<?php

namespace app\models;

use Yii;
use app\models\Users;

class AuthUsers extends \yii\base\Object implements \yii\web\IdentityInterface
{

    public $user_id;
    public $username;
    public $first_name;
    public $last_name;
    public $password;
    public $photo;
    public $email;
    public $dob;
    public $phone;
    public $mobile;
    public $temp_address;
    public $perm_address;
    public $bank_name;
    public $account_number;
    public $ifsc;
    public $passport;
    public $exp_latter;
    public $identity_proof_id;
    public $created_at;
    public $role_id;
    public $login_time;
    public $logout_time;
    public $is_deleted;
    public $authKey;

    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {

        $dbUser = Users::find()
            ->select([
                'user_id',
                'username',
                'first_name',
                'last_name',
                'password',
                'photo',
                'email',
                'dob',
                'phone',
                'mobile',
                'temp_address',
                'perm_address',
                'bank_name',
                'account_number',
                'ifsc',
                'passport',
                'exp_latter',
                'created_at',
                'role_id',
                'login_time',
                'logout_time',
                'is_deleted',

            ])
            ->where(['user_id' => $id, 'is_deleted' => 0])
            ->one();
        if (!count($dbUser)) {
            return null;
        }
        return new static($dbUser);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {

        $dbUser = Users::find()
            ->where(["accessToken" => $token])
            ->one();
        if (!count($dbUser)) {
            return null;
        }
        return new static($dbUser);
    }

    /**
     * Finds user by username
     *
     * @param  string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        $dbUser = Users::find()
            ->select([
                'user_id',
                'username',
                'first_name',
                'last_name',
                'password',
                'photo',
                'email',
                'dob',
                'phone',
                'mobile',
                'temp_address',
                'perm_address',
                'bank_name',
                'account_number',
                'ifsc',
                'passport',
                'exp_latter',
                'created_at',
                'role_id',
                'login_time',
                'logout_time',
                'is_deleted',

            ])
            ->where(['username' => $username, 'is_deleted' => 0])
            ->one();
        if (!count($dbUser)) {
            return null;
        }
        return new static($dbUser);
    }

    public function getRoleId()
    {
        return $this->role_id;
    }


    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->user_id;
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->authKey;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->authKey === $authKey;
    }

    /**
     * Validates password
     *
     * @param  string $password password to validate
     * @return boolean if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password);
    }

    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password = Yii::$app->security->generatePasswordHash($password);
    }

}
