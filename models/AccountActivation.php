<?php
/**
 * Created by PhpStorm.
 * User: 13
 * Date: 09.05.2018
 * Time: 6:45
 */
namespace app\models;
use yii\base\NotSupportedException;
use yii\base\Model;
use Yii;
/* @property string $username */
class AccountActivation extends Model
{
    /* @var $user \app\models\User */
    private $_user;
    public function __construct($key, $config = [])
    {
        if(empty($key) || !is_string($key))
            throw new NotSupportedException('Key can not be empty!');
        $this->_user = User::findBySecretKey($key);
        if(!$this->_user)
            throw new NotSupportedException('Key is wrong!');
        parent::__construct($config);
    }
    public function activateAccount()
    {
        $user = $this->_user;
        $user->status = User::STATUS_ACTIVE;
        $user->removeSecretKey();
        return $user->save();
    }
    public function getUsername()
    {
        $user = $this->_user;
        return $user->username;
    }
}