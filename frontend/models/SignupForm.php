<?php
namespace frontend\models;

use common\models\User;
use yii\base\Model;
use Yii;

/**
 * Signup form
 */
class SignupForm extends Model
{
    public $username;
    public $email;
    public $password;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['username', 'filter', 'filter' => 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This username has already been taken.'],
            ['username', 'string', 'min' => 2, 'max' => 255],

            ['email', 'filter', 'filter' => 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This email address has already been taken.'],

            ['password', 'required'],
            ['password', 'string', 'min' => 6],
        ];
    }

    public function attributeLabels()
    {
        return [
            'username' => Yii::t('frontend', 'username'),
            'email' => Yii::t('frontend', 'email'),
            'password' => Yii::t('frontend', 'password'),
        ];
    }
    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function signup()
    {
        if ($this->validate()) {
            $user = new User();
            $user->username = $this->username;
            $user->email = $this->email;
            $user->setPassword($this->password);
            $user->generateAuthKey();
            if ($user->save()) {
                return $user;
            }
        }

        return null;
    }

    public function sendEmail()
    {
        /* @var $user User */
        $user = User::findOne([
            'email' => $this->email,
        ]);

        if ($user) {

            if(!User::isPasswordResetTokenValid($user->activate_token)){
                $user->generateActivateToken();
            }

            if ($user->save()) {
                return Yii::$app->mailer->compose('activateAccountToken-html', ['user'       => $user,
                    'title'      => 'Activate account',
                    'htmlLayout' => 'layouts/html'])
                    ->setFrom('artur999033@gmail.com')
                    ->setTo($this->email)
                    ->setSubject('Activate your account' . Yii::$app->params['siteName'])
                    ->send();
            }
        }

        return false;
    }
}
