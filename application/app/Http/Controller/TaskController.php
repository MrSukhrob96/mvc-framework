<?php
/**
 * Created by PhpStorm.
 * User: jakhar
 * Date: 11/19/19
 * Time: 2:36 PM
 */

namespace App\Http\Controller;


use App\DTO\CreateTaskDTO;
use App\Helpers\SortHelper;
use App\Models\Task;
use App\Models\User;
use App\Repositories\TaskRepository;
use App\Repositories\UserRepository;
use Framework\AbstractController;
use Framework\Framework;
use Respect\Validation\Validator;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class TaskController
 * @package App\Http\Controller
 */
class TaskController extends AbstractController
{
    /**
     * @var TaskRepository
     */
    private $repository;
    /**
     * @var UserRepository
     */
    private $userRepository;

    /**
     * TaskController constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->repository = $this->db->getRepository(Task::class);
        $this->userRepository = $this->db->getRepository(User::class);
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(Request $request)
    {
        $formAlert = ['error' => [],'success' => []];

        if ($request->isMethod("POST")) {
            $formAlert['error'] = $this->validationFormCreate();
            if (count($formAlert['error']) == 0) {
                try {

                    $createDTO = new CreateTaskDTO();
                    $createDTO->username = $request->request->get('username');
                    $createDTO->email = $request->request->get('email');
                    $createDTO->description = $request->request->get('description');
                    $task = $this->repository->create($createDTO);
                    if(is_a($task,Task::class)){
                        $formAlert['success']['added'] = "Task successfully added";
                    }

                } catch (\Exception $exception) {
                    $formAlert['error']['exception'] = $exception->getMessage();
                }
            }
        }

        $sortAttributes = $this->repository->getSortAttributes();
        $page = $request->get('page') ?? 1;
        $oderBy = SortHelper::getDirectionSort();
        $tasks = $this->repository->getAllWithPagination([], 3, $page, $oderBy);

        return $this->render('index', [
            'tasks' => $tasks,
            'totalPages' => $this->repository->totalPages,
            'currentPage' => ($request->get('page') ?? 1),
            'sortAttributes' => $sortAttributes,
            'sort' => SortHelper::getDirectionSort(),
            'formAlert' => $formAlert
        ]);
    }

    /**
     * @param Request $request
     * @return RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function update(Request $request)
    {
        $formAlert = ['error' => [],'success' => []];

        if (Framework::$auth->getStatus() !== "VALID") {
            return new RedirectResponse(Framework::$urlGenerator->generate('login'));
        }

        if (count($formAlert['error']) == 0) {
            if (validator::intType()->validate((int)Framework::$request->get('id'))) {
                $task = $this->repository->find((int)$request->get('id'));
            }

            /**
             * @var $task Task
             */
            if (!is_a($task, Task::class)) {
                $formAlert['error']['not_founded'] = "Task is not founded";
            }
            if ($request->isMethod("POST")) {
                $formAlert['error'] = $this->validationFormUpdate();
                if (count($formAlert['error']) == 0) {
                    try {
                        $task->setStatus($request->request->get('status'));

                        $oldDescription = $task->getDescription();
                        $newDescription = $task->setDescription($request->request->get('description'));
                        if ($oldDescription !== $newDescription) {
                            $task->setUpdatedAt();
                            $formAlert['info']['updated_admin'] = "Marked as changed by administrator";

                        }
                        $this->db->flush();
                        $formAlert['success']['updated'] = "Task updated successfully";
                    } catch (\Exception $exception) {
                        $formAlert['error']['exception'] = $exception->getMessage();
                    }
                }
            }

        }

        $sortAttributes = $this->repository->getSortAttributes();
        $page = $request->get('page') ?? 1;
        $oderBy = SortHelper::getDirectionSort();
        $tasks = $this->repository->getAllWithPagination([], 3, $page, $oderBy);

        return $this->render('update', [
            'tasks' => $tasks,
            'totalPages' => $this->repository->totalPages,
            'currentPage' => ($request->get('page') ?? 1),
            'sortAttributes' => $sortAttributes,
            'sort' => SortHelper::getDirectionSort(),
            'formAlert' => $formAlert,
            'task' => $task
        ]);
    }

    /**
     * @return array
     */
    private function validationFormCreate()
    {
        $formErrors = [];
        if (!validator::email()
            ->validate(Framework::$request->request->get('email'))
        ) {
            $formErrors['email'] = "You did not enter an email";
        }

        if (!validator::stringType()
            ->length(1, 50)
            ->validate(Framework::$request->request->get('username'))
        ) {
            $formErrors['username'] = "Username string length is incorrect";
        }

        if (!validator::stringType()
            ->length(1, 255)
            ->validate(Framework::$request->request->get('description'))
        ) {
            $formErrors['description'] = "Description string length is incorrect";
        }
        return $formErrors;
    }

    /**
     * @return array
     */
    private function validationFormUpdate()
    {
        $formErrors = [];


        if (!validator::intType()->validate((int)Framework::$request->get('id'))) {
            $formErrors['id'] = "ID is wrong";
        }

        if (!validator::in([
            Task::STATUS_INACTIVE,
            Task::STATUS_ACTIVE,
            Task::STATUS_COMPLETED
        ])->validate((int)Framework::$request->request->get('status'))
        ) {
            $formErrors['status'] = "Status is wrong";
        }

        if (!validator::stringType()
            ->length(1, 255)
            ->validate(Framework::$request->request->get('description'))
        ) {
            $formErrors['description'] = "Description string length is incorrect";
        }
        return $formErrors;
    }
}