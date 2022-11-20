<?php

namespace MyProject\Models\Users;

use MyProject\Models\ActiveRecordEntity;
use MyProject\Exceptions\InvalidArgumentException;

class User extends ActiveRecordEntity
{
    /** @var string */
    protected $nickname;

    /** @var string */
    protected $email;

    /** @var int */
    protected $isConfirmed;

    /** @var string */
    protected $role;

    /** @var string */
    protected $passwordHash;

    /** @var string */
    protected $authToken;

    /** @var string */
    protected $createdAt;

    /**
     * @return string
     */
    public function getNickname(): string
    {
        return $this->nickname;
    }

    protected static function getTableName(): string
    {
        return 'users';
    }

    public static function signUp(array $userData)
    {
        //NICKNAME
        if (empty($userData['nickname'])) {
            throw new InvalidArgumentException('Не передан nickname');
        }
        if (!preg_match('/^[a-zA-Z0-9]+$/', $userData['nickname'])) {
            throw new InvalidArgumentException('Nickname может состоять только из символов латинского алфавита и цифр');
        }
        if (static::findOneByColumn('nickname', $userData['nickname']) !== null) {
            throw new InvalidArgumentException('Пользователь с таким nickname уже существует');
        }
    
        
        //EMAIL
        if (empty($userData['email'])) {
            throw new InvalidArgumentException('Не передан email');
        }
        if (!filter_var($userData['email'], FILTER_VALIDATE_EMAIL)) {
            throw new InvalidArgumentException('Email некорректен');
        }
        if (static::findOneByColumn('email', $userData['email']) !== null) {
            throw new InvalidArgumentException('Пользователь с таким email уже существует');
        }
        
        //PASSWORD
        if (empty($userData['password'])) {
            throw new InvalidArgumentException('Не передан password');
        }
        if (mb_strlen($userData['password']) < 8) {
            throw new InvalidArgumentException('Пароль должен быть не менее 8 символов');
        }
    }
}
