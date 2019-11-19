<?php
/**
 * Created by PhpStorm.
 * User: jakhar
 * Date: 11/19/19
 * Time: 1:41 PM
 */

namespace App\Repositories;


use Doctrine\ORM\EntityRepository;

class UserRepository extends EntityRepository
{
    /**
     * @param $email
     * @return object|null
     */
    public function findByEmail($email)
    {
        return $this->findOneBy(['email' => $email]);
    }

    /**
     * @param $username
     * @return object|null
     */
    public function findByUsername($username)
    {
        return $this->findOneBy(['username' => $username]);
    }

    /**
     * @param $email
     * @param $password
     * @return object|null
     */
    public function findByUsernameAndPassword($username, $password)
    {
        $password = md5($password);
        return $this->findOneBy(['username' => $username, 'password' => $password]);
    }

}