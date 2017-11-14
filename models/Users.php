<?php

namespace app\models;

use Yii;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "users".
 *
 * @property string $user_id
 * @property string $username
 * @property string $first_name
 * @property string $last_name
 * @property string $password
 * @property string $photo
 * @property string $email
 * @property string $dob
 * @property string $phone
 * @property string $mobile
 * @property string $temp_address
 * @property string $perm_address
 * @property string $bank_name
 * @property integer $account_number
 * @property string $ifsc
 * @property integer $identity_proof_id
 * @property string $passport
 * @property string $exp_latter
 * @property string $created_at
 * @property integer $role_id
 * @property string $login_time
 * @property string $logout_time
 * @property integer $is_deleted
 *
 * @property Identity[] $identities
 */
class Users extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
{
    public $images, $authKey, $user_role, $status, $raw_password;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'users';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['photo', 'email', 'dob', 'mobile', 'perm_address', 'bank_name', 'account_number', 'ifsc', 'created_at', 'first_name', 'last_name', 'ctc'], 'required'],
            [['dob', 'created_at', 'login_time', 'logout_time', 'images', 'password', 'role_id', 'user_role', 'status', 'raw_password'], 'safe'],
            [['temp_address', 'perm_address'], 'string'],
            [['account_number', 'identity_proof_id', 'role_id', 'is_deleted', 'ctc'], 'integer'],
            [['username', 'email', 'bank_name', 'passport', 'exp_latter'], 'string', 'max' => 100],
            [['photo'], 'string', 'max' => 200],
            [['phone', 'mobile'], 'string', 'max' => 20],
            [['ifsc'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'user_id' => 'User ID',
            'username' => 'Username',
            'photo' => 'User Profile Picture',
            'email' => 'Email',
            'dob' => 'Dob',
            'phone' => 'Phone',
            'mobile' => 'Mobile',
            'temp_address' => 'Temporary Address',
            'perm_address' => 'Permanent Address',
            'bank_name' => 'Bank Name',
            'account_number' => 'Account Number',
            'ifsc' => 'IFSC Code',
            //'identity_proof_id' => 'Identity Proof ID',
            'passport' => 'Passport',
            'exp_latter' => 'Experience Latter',
            'created_at' => 'Created At',
            'role_id' => 'User Role',
            'login_time' => 'Login Time',
            'logout_time' => 'Logout Time',
            'is_deleted' => 'Is Deleted',
            'images' => 'Documents',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdentities()
    {
        return $this->hasMany(Identity::className(), ['user_id' => 'user_id']);
    }

    public function getRoles()
    {
        return $this->hasOne(Roles::className(), ['role_id' => 'role_id']);
    }

    /**
     * @inheritdoc
     */

    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        $dbUser = BsAdmin::find()->where(["accessToken" => $token])->one();
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
        return static::findOne(['username' => $username]);
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
        return Yii::$app->getSecurity()->validatePassword($password, $this->password);
    }

    public function setPassword($password)
    {
        $this->password = Yii::$app->security->generatePasswordHash($password);
    }
}
