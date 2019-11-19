<?php
/**
 * Created by PhpStorm.
 * User: jakhar
 * Date: 11/19/19
 * Time: 10:54 AM
 */

namespace Framework;


use Doctrine\ORM\EntityManager;
use ReflectionClass;

/**
 * Class AbstractController
 * @package Framework
 */
abstract class AbstractController
{
    /**
     * @var EntityManager
     */
    public $db;

    /**
     * @var string
     */
    public $viewPath;

    /**
     * @var string
     */
    public $layout = "main";

    /**
     * @var string
     */
    private $controllerName;

    /**
     * AbstractController constructor.
     */
    function __construct()
    {
        $this->initViewsPath();
        $this->initDb();
    }

    /**
     * void
     */
    public function initDb()
    {
        $this->db = Framework::$db;
    }

    /**
     * @param $views
     * @param array $params
     * @return \Symfony\Component\HttpFoundation\Response
     * @throws \Exception
     */
    public function render($views, $params = [])
    {
        $content = $this->renderContent($views, $params);
        $layout = _LAYOUTS_ . "/" . $this->layout;
        return new \Symfony\Component\HttpFoundation\Response(renderFile($layout, ['content' => $content]));
    }

    /**
     * @param $view
     * @param array $params
     * @return string|null
     * @throws \Exception
     */
    public function renderContent($view, $params = [])
    {
        $params['controller'] = $this;
        return renderFile($this->viewPath . $view, $params);
    }

    /**
     * @return mixed
     */
    public function getControllerName()
    {
        return $this->controllerName;
    }

    /**
     * @return string|null
     * @throws \ReflectionException
     */
    private function initViewsPath(): ?string
    {
        $shortName = (new ReflectionClass($this))->getShortName();
        preg_match_all("#[A-Z_]{1}[a-z0-9]+#", $shortName, $result);
        array_pop($result[0]);
        $this->controllerName = mb_strtolower(implode("-", $result[0]));
        $this->viewPath = _VIEWS_ . "/" . $this->controllerName . "/";
        return $this->viewPath;
    }
}