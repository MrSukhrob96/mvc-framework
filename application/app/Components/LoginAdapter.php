<?php

namespace App\Components;

use App\Models\User;
use Aura\Auth\Adapter\AdapterInterface;
use Aura\Auth\Auth;
use Aura\Auth\Status;
use Framework\Framework;

/**
 * Class LoginAdapter
 * @package App\Components
 */
class LoginAdapter implements AdapterInterface
{
    /**
     * @param array $input
     * @return array
     */
    public function login(array $input)
    {
        /**
         * @var $user User
         */
        $user = Framework::$db->getRepository(User::class)->findByUsernameAndPassword(
            $input['username'],
            $input['password']
        );


        if (!is_a($user, User::class)) {
            throw new \DomainException("Incorrect username or password");
        }

        if($user->getRole() !== User::ROLE_ADMIN){
            throw new \DomainException("Admin Only Login");
        }

        return [$user->getEmail(), ['id' => $user->getId(), 'username' => $user->getUsername()]];
    }

    /**
     * @param Auth $auth
     * @param string $status
     * @return void|null
     */
    public function logout(Auth $auth, $status = Status::ANON)
    {
    }

    /**
     * @param Auth $auth
     * @return void|null
     */
    public function resume(Auth $auth)
    {

    }
}