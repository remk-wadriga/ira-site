<?php

namespace models;

use Yii;
use abstracts\ModelAbstract;
use yii\db\Query;

/**
 * This is the model class for table "tag".
 *
 * @property string $entityID
 * @property string $entityClass
 * @property string $tag
 */
class Tag extends ModelAbstract
{
    public static function tableName()
    {
        return 'tag';
    }

    public function rules()
    {
        return [
            [['entityID', 'entityClass', 'tag'], 'required'],
            [['entityID'], 'integer'],
            [['entityClass', 'tag'], 'string', 'max' => 126]
        ];
    }

    public function attributeLabels()
    {
        return [

        ];
    }

    // Behaviors

    // END Behaviors


    // Depending

    // END Depending


    // Event handlers

    // END Event handlers


    // Getters and setters

    // entityID
    public function getEntityID()
    {
        return $this->entity_id;
    }
    public function setEntityID($entity_id)
    {
        $this->entity_id = $entity_id;
    }

    // entityClass
    public function getEntityClass()
    {
        return $this->entity_class;
    }
    public function setEntityClass($entity_class)
    {
        $this->entity_class = $entity_class;
    }

    // END Getters and setters


    // Public methods

    // END Public methods


    // Public static methods

    /**
     * @param integer $entityID
     * @param string $entityClass
     * @return string[]
     */
    public static function getEntityTags($entityClass, $entityID = null)
    {
        $list = [];
        $conditions = [];
        if ($entityID !== null) {
            $conditions['entity_id'] = $entityID;
        }
        $conditions['entity_class'] = $entityClass;

        $tags = (new Query())
            ->select('tag')
            ->from(self::tableName())
            ->where($conditions)
            ->all();
        foreach ($tags as $tag) {
            if (!in_array($tag['tag'], $list)) {
                $list[] = $tag['tag'];
            }
        }
        return $list;
    }

    public static function addEntityTag($entityID, $entityClass, $tag)
    {
        $params = [
            'entity_id' => $entityID,
            'entity_class' => $entityClass,
            'tag' => $tag,
        ];
        return (bool)Yii::$app->db->createCommand()->insert(self::tableName(), $params)->execute();
    }

    public static function removeEntityTag($entityID, $entityClass, $tag)
    {
        $conditions = [
            'entity_id' => $entityID,
            'entity_class' => $entityClass,
            'tag' => $tag,
        ];
        return (bool)Yii::$app->db->createCommand()->delete(self::tableName(), $conditions)->execute();
    }

    // END Public static methods


    // Protected methods

    // END Protected methods


    // Protected static methods

    // END Protected static methods


    // Private methods

    // END Private methods


    // Private static methods

    // END Private static methods


    // Implements <some interface>

    // END Implements <some interface>
}
