<?php
namespace App\Http\Controller;


use App\Models\User;
use App\Repositories\UserRepository;
use Framework\AbstractController;
use Framework\Framework;
use Respect\Validation\Validator;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class UserController
 * @package App\Http\Controller
 */
class UserController extends AbstractController
{

    /**
     * @var UserRepository
     */
    private $repository;

    /**
     * UserController constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->repository = $this->db->getRepository(User::class);
    }

    /**
     * @param Request $request
     * @return RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function login(Request $request)
    {
        if (Framework::$auth->getStatus() == "VALID") {
            return new RedirectResponse(Framework::$urlGenerator->generate('home'));
        }

        $formErrors = [];

        if ($request->isMethod("POST")) {
            if (!validator::length(1)
                ->validate(Framework::$request->request->get('username'))
            ) {
                $formErrors['username'] = "You did not enter username";
            }

            if (!validator::length(1)
                ->validate(Framework::$request->request->get('password'))
            ) {
                $formErrors['password'] = "You did not enter password";
            }

            if (count($formErrors) == 0) {
                try {
                    Framework::$authLoginService->login(Framework::$auth, [
                        'username' => Framework::$request->request->get('username'),
                        'password' => Framework::$request->request->get('password')
                    ]);
                } catch (\Exception $exception) {
                    $formErrors['error'] = $exception->getMessage();
                }
            }

            if (count($formErrors) == 0) {
                return new RedirectResponse(Framework::$urlGenerator->generate('home'));
            }

        }


        return $this->render("login", ['formErrors' => $formErrors]);
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function logout(Request $request)
    {
        if (Framework::$auth->getStatus() !== "VALID") {
            return new RedirectResponse(Framework::$urlGenerator->generate('home'));
        }
        Framework::$authLogoutService->logout(Framework::$auth);
        return new RedirectResponse(Framework::$urlGenerator->generate('login'));
    }
}
