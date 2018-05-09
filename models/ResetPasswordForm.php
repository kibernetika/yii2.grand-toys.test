<?php
/**
 * Created by PhpStorm.
 * User: 13
 * Date: 09.05.2018
 * Time: 6:44
 */
namespace app\models;
use Yii;
use yii\base\Model;
use yii\base\NotSupportedException;

class ResetPasswordForm extends Model
{
    public $password;
    private $_user;
    public function rules()
    {
        return [
            ['password', 'required']
        ];
    }
    public function attributeLabels()
    {
        return [
            'password' => 'Password'
        ];
    }
    public function __construct($key, $config = [])
    {
        if(empty($key) || !is_string($key))
            throw new NotSupportedException('Key can not be empty!');
        $this->_user = User::findBySecretKey($key);
        if(!$this->_user)
            throw new NotSupportedException('Key is wrong!');
        parent::__construct($config);
    }
    public function resetPassword()
    {
        /* @var $user User */
        $user = $this->_user;
        $user->setPassword($this->password);
        $user->removeSecretKey();
        return $user->save();
    }
}