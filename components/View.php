<?php
/**
 * Created by Rem.
 * Author: Dmitry Kushneriv
 * Email: remkwadriga@yandex.ua
 * Date: 12-08-2015
 * Time: 15:59 PM
 */

namespace components;

use Yii;
use yii\web\View as YiiView;

/**
 * Class View
 * @package components
 *
 * @property array $scriptParams
 */
class View extends YiiView
{
    private $_scriptParams = [];

    /**
     * Translate string
     *
     * @param $message
     * @param array $params
     * @param string $path
     * @param null $language
     * @return string
     */
    public function t($message, $params = [], $path = 'app', $language = null)
    {
        return Yii::t($path, $message, $params, $language);
    }

    public function render($view, $params = [], $context = null)
    {
        $module = Yii::$app->controller->module;
        if ($module !== null) {
            $view = str_replace('@views/', '@' . $module->id . 'Views/', $view);
        }
        return parent::render($view, $params, $context);
    }

    public function hasError()
    {
        return Yii::$app->getSession()->hasFlash('error');
    }

    public function hasSuccess()
    {
        return Yii::$app->getSession()->hasFlash('success');
    }

    public function getError()
    {
        return Yii::$app->getSession()->getFlash('error');
    }

    public function getSuccess()
    {
        return Yii::$app->getSession()->getFlash('success');
    }

    public function getConfirmDeleteText()
    {
        return $this->t('Are you sure you want to delete this item') . '?';
    }

    // scriptParams
    public function setScriptParams($params = [])
    {
        $this->_scriptParams = array_merge($this->_scriptParams, $params);
    }
    public function getScriptParams()
    {
        return $this->_scriptParams;
    }
}