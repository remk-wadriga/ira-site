<?php
/**
 * Created by PhpStorm.
 * User: Dima
 * Date: 02.03.2016
 * Time: 21:24
 */

namespace abstracts;

use Yii;
use yii\web\Controller;

abstract class ControllerAbstract extends Controller
{
    protected $disableAssets = false;

    public function t($message, $params = [], $direction = 'app')
    {
        return Yii::$app->view->t($message, $params, $direction);
    }

    /**
     * render
     * @param null $view
     * @param array $params
     * @return string
     */
    public function render($view = null, $params = [])
    {
        if (is_array($view)) {
            $params = $view;
            $view = null;
        }

        if ($view === null) {
            $view = $this->action->id;
        }

        return parent::render($view, $params);
    }

    public function isPost()
    {
        return Yii::$app->getRequest()->getIsPost();
    }

    public function isAjax()
    {
        return Yii::$app->getRequest()->getIsAjax();
    }

    public function post($param = null, $default = null)
    {
        return Yii::$app->getRequest()->post($param, $default);
    }

    public function get($param = null, $default = null)
    {
        return Yii::$app->getRequest()->get($param, $default);
    }

    public function params()
    {
        return Yii::$app->getRequest()->getQueryParams();
    }

    public function setFlash($key, $value = true, $removeAfterAccess = true)
    {
        Yii::$app->getSession()->setFlash($key, $value, $removeAfterAccess);
    }

    public function setSuccess($message, $removeAfterAccess = true)
    {
        Yii::$app->getSession()->setFlash('success', $message, $removeAfterAccess);
    }

    public function setError($message, $removeAfterAccess = true)
    {
        Yii::$app->getSession()->setFlash('error', $message, $removeAfterAccess);
    }
}