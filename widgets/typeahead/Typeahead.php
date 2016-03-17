<?php
/**
 * Created by PhpStorm.
 * User: Dima
 * Date: 15.03.2016
 * Time: 1:46
 */

namespace widgets\typeahead;

use Yii;
use yii\base\ErrorException;
use yii\bootstrap\Widget;
use abstracts\ModelAbstract;
use yii\db\Query;
use models\Tag;
use yii\helpers\Json;
use yii\helpers\Url;

class Typeahead extends Widget
{
    /**
     * @var \abstracts\ModelAbstract
     */
    public $entity;
    public $class = 'typeahead';
    public $inputClass = 'typeahead-input';

    private $_data;
    private $_tags;

    public function init()
    {
        parent::init();
        if ($this->entity === null || !($this->entity instanceof ModelAbstract)) {
            throw new ErrorException(Yii::$app->view->t('Invalid entity'));
        }
    }

    public function run()
    {
        BootstrapTypeaheadAsset::register(Yii::$app->view);
        $this->registerScript();

        return $this->render('block', [
            'tags' => $this->getTags(),
            'entity' => $this->entity,
            'class' => $this->class,
            'inputClass' => $this->inputClass,
        ]);
    }

    private function getData()
    {
        if ($this->_data === null) {
            $this->_data = [];
            $entity = $this->entity;

            $tags = (new Query())
                ->select('tag')
                ->from(Tag::tableName())
                ->where(['entity_class' => $entity::className()])
                ->andWhere(['!=', 'entity_id', $entity->getID()])
                ->all();
            foreach ($tags as $tag) {
                $this->_data[] = $tag['tag'];
            }
        }
        return $this->_data;
    }

    private function getTags()
    {
        if ($this->_tags === null) {
            $entity = $this->entity;

            $this->_tags = Tag::getEntityTags($entity::className(), $entity->getID());
        }
        return $this->_tags;
    }

    private function registerScript()
    {
        $entity = $this->entity;
        $data = Json::encode($this->getData());
        $tags = Json::encode($this->getTags());
        $addUrl = Url::to(['/admin/api/add-tag', 'entityClass' => $entity::className(), 'entityID' => $entity->getID()]);
        $removeUrl = Url::to(['/admin/api/remove-tag', 'entityClass' => $entity::className(), 'entityID' => $entity->getID()]);
        $script = "TypeaheadScript.init({blockID:'.{$this->class}', tags:{$tags}, addUrl:'{$addUrl}', removeUrl:'{$removeUrl}'});";
        $script .= "$('input.{$this->inputClass}').typeahead({source:{$data}, autoSelect:true, afterSelect:function(tag){TypeaheadScript.addTag(tag)}});";
        Yii::$app->view->registerJs($script);
    }
}