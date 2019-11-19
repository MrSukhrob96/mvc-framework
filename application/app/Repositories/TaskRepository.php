<?php
/**
 * Created by PhpStorm.
 * User: jakhar
 * Date: 11/19/19
 * Time: 1:41 PM
 */

namespace App\Repositories;


use App\DTO\CreateTaskDTO;
use App\Helpers\SortHelper;
use App\Models\Task;
use App\Models\User;
use Doctrine\ORM\EntityRepository;

/**
 * Class TaskRepository
 * @package App\Repositories
 */
class TaskRepository extends EntityRepository
{
    public $totalPages = 0;
    public $currentPage = 0;
    public $perPage = 0;
    public $orderBy = null;
    public $criteria = [];

    /**
     * @param array $criteria
     * @param int $limit
     * @param int $page
     * @param null $orderBy
     * @return mixed
     */
    public function getAllWithPagination($criteria = [], $limit = 3, $page = 1, $orderBy = null)
    {
        $this->criteria = $criteria;
        $this->currentPage = $page;
        $this->perPage = $limit;
        $this->orderBy = $orderBy;
        $query = $this->getEntityManager()->createQueryBuilder()
            ->select(['t.id,t.description,t.status as status,t.updated_at,t.created_at,u.username as username,u.email as email'])
            ->from(Task::class, 't')
            ->leftJoin(User::class, 'u', 'with', 't.author = u.id');

        if (is_array($orderBy) && count($orderBy) > 0) {
            $sortColumn = key($orderBy);
            $sortOrder = current($orderBy);
            $query->orderBy($sortColumn, $sortOrder);
        }
        $all = $query->getQuery()
            ->getResult();

        try {
            $this->totalPages = ceil(count($all) / $limit);
        } catch (\Exception $exception) {
            $this->totalPages = 1;
        }
        $offset = ($limit * $this->currentPage) - $limit;
        return $query->setMaxResults($limit)->setFirstResult($offset)->getQuery()->getResult();
    }

    /**
     * @param CreateTaskDTO $dto
     * @return Task|null
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function create(createTaskDTO $dto): ?Task
    {
        /**
         * @var $userRepository UserRepository
         */
        $userRepository = $this->getEntityManager()->getRepository(User::class);
        $user = $userRepository->findByUsername($dto->username);

        if (!is_a($user, User::class)) {
            $user = $userRepository->findByEmail($dto->email);
            if (!is_a($user, User::class)) {
                $user = new User();
                $user->setUsername($dto->username);
                $user->setEmail($dto->email);
                $user->setPassword("123");
                $this->getEntityManager()->persist($user);
                $this->getEntityManager()->flush();
            }
        }

        $task = new Task();
        $task->setDescription($dto->description);
        $task->setAuthor($user);
        $task->setCreatedAt();
        $this->getEntityManager()->persist($task);
        $this->getEntityManager()->flush();
        return $task;
    }

    /**
     * @return array|null
     */
    public function getSortAttributes(): ?array
    {
        return [
            'username' => [
                'title' => 'User Name',
                'link' => SortHelper::getLink('username')
            ],
            'email' => [
                'title' => 'Email',
                'link' => SortHelper::getLink('email')
            ],
            'status' => [
                'title' => 'Status',
                'link' => SortHelper::getLink('status')
            ]
        ];
    }
}