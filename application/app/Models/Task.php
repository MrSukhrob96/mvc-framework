<?php
namespace App\Models;

use DateTime;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repositories\TaskRepository")
 * @ORM\Table(name="tasks")
 */
class Task
{
    const STATUS_ACTIVE = 1;
    const STATUS_INACTIVE = 0;
    const STATUS_COMPLETED = 2;

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    protected $id;

    /**
     * @ORM\Column(type="text")
     */
    protected $description;

    /**
     * @ORM\Column(type="datetime")
     */
    protected $created_at;

    /**
     * @ORM\Column(type="datetime",nullable=true)
     */
    protected $updated_at = null;


    /**
     * @ORM\Column(type="integer")
     */
    protected $status = self::STATUS_ACTIVE;

    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="tasks")
     * @ORM\JoinColumn(name="author", referencedColumnName="id")
     */
    protected $author;


    public function getId()
    {
        return $this->id;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($description)
    {
        return $this->description = htmlspecialchars($description);
    }

    public function setCreatedAt(DateTime $created = null)
    {
        if ($created == null) {
            $created = new DateTime();
        }
        $this->created_at = $created;
    }

    public function getCreatedAt()
    {
        return $this->created_at;
    }


    public function setUpdatedAt(DateTime $updated = null)
    {
        if ($updated == null) {
            $updated = new DateTime();
        }
        $this->updated_at = $updated;
    }

    public function getUpdatedAt()
    {
        return $this->updated_at;
    }


    public function setStatus($status)
    {
        $this->status = $status;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function setAuthor(?User $user): self
    {
        $this->author = $user;
        return $this;
    }

    public function getAuthor(): ?User
    {
        return $this->author;
    }

}
