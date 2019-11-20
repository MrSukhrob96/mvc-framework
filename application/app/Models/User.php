<?php
namespace App\Models;

use Doctrine\ORM\Mapping as ORM;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

/**
 * @ORM\Entity(repositoryClass="App\Repositories\UserRepository")
 * @ORM\Table(name="users",uniqueConstraints={@ORM\UniqueConstraint(name="email_unique_key", columns={"email"}),@ORM\UniqueConstraint(name="username_unique_key", columns={"username"})})
 */
class User
{

    const ROLE_USER = 1;
    const ROLE_ADMIN = 2;


    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @var int
     */
    protected $id;

    /**
     * @ORM\Column(type="string")
     * @var string
     */
    protected $username;


    /**
     * @ORM\Column(type="string")
     * @var string
     */
    protected $password;

    /**
     * @ORM\Column(type="string")
     * @var string
     */
    protected $email;

    /**
     * @ORM\Column(type="integer")
     * @var integer
     */
    protected $role = self::ROLE_USER;

    public function getId()
    {
        return $this->id;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function setUsername($username)
    {
        $this->username = htmlspecialchars($username);
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }


    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword($password = null)
    {
        $this->password = md5($password);
    }


    public function getRole()
    {
        return $this->role;
    }

    public function setRole($role)
    {
        $this->role = $role;
    }

    /**
     * @ORM\OneToMany(targetEntity="Task", mappedBy="created_by")
     * @var Task[] An ArrayCollection of Task objects.
     */
    protected $tasks;


    public function __construct()
    {
        $this->tasks = new ArrayCollection();
    }

    /**
     * @return Collection|Task[]
     */
    public function getTasks(): Collection
    {
        return $this->tasks;
    }

}
