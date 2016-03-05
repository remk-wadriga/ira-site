<?php

namespace models;

use Yii;
use abstracts\ModelAbstract;
use yii\db\Query;
use yii\helpers\Json;
use interfaces\StoryInterface;

/**
 * This is the model class for table "story".
 *
 * @property integer $id
 * @property string $targetClass
 * @property integer $targetID
 * @property integer $userID
 * @property string $action
 * @property string $date
 * @property string $fieldsJson
 * @property string $oldValuesJson
 * @property string $newValuesJson
 * @property string $fields
 * @property string $oldValues
 * @property string $newValues
 *
 * @property User $user
 */
class Story extends ModelAbstract
{
    public static function tableName()
    {
        return 'story';
    }

    public function rules()
    {
        return [
            [['targetClass', 'targetID', 'userID', 'action', 'date'], 'required'],
            [['targetID', 'userID'], 'integer'],
            [['date', 'fields', 'oldValues', 'newValues'], 'safe'],
            [['fieldsJson', 'oldValuesJson', 'newValuesJson'], 'string'],
            [['targetClass', 'action'], 'string', 'max' => 255]
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

    /**
     * @return Query
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    // END Depending


    // Event handlers

    public function beforeValidate()
    {
        if (!parent::beforeValidate()) {
            return false;
        }

        if (!$this->userID) {
            $this->userID = Yii::$app->user->getId();
        }
        if (!$this->date) {
            $this->date = Yii::$app->time->getCurrentDateTime();
        }

        return true;
    }

    // END Event handlers


    // Getters and setters

    // targetClass
    public function getTargetClass()
    {
        return $this->target_class;
    }
    public function setTargetClass($target_class)
    {
        $this->target_class = $target_class;
    }

    // targetID
    public function getTargetID()
    {
        return $this->target_id;
    }
    public function setTargetID($target_id)
    {
        $this->target_id = $target_id;
    }

    // userID
    public function getUserID()
    {
        return $this->user_id;
    }
    public function setUserID($user_id)
    {
        $this->user_id = $user_id;
    }

    // fieldsJson
    public function getFieldsJson()
    {
        return $this->fields_json;
    }
    public function setFieldsJson($fields_json)
    {
        $this->fields_json = $fields_json;
    }

    // oldValuesJson
    public function getOldValuesJson()
    {
        return $this->old_values_json;
    }
    public function setOldValuesJson($old_values_json)
    {
        $this->old_values_json = $old_values_json;
    }

    // newValuesJson
    public function getNewValuesJson()
    {
        return $this->new_values_json;
    }
    public function setNewValuesJson($new_values_json)
    {
        $this->new_values_json = $new_values_json;
    }

    // fields
    public function getFields()
    {
        return Json::decode($this->fieldsJson);
    }
    public function setFields($fields)
    {
        $this->fieldsJson = Json::encode($fields);
    }

    // oldValues
    public function getOldValues()
    {
        return Json::decode($this->oldValuesJson);
    }
    public function setOldValues($old_values)
    {
        $this->oldValuesJson = Json::encode($old_values);
    }

    // newValues
    public function getNewValues()
    {
        return Json::decode($this->newValuesJson);
    }
    public function setNewValues($new_values)
    {
        $this->newValuesJson = Json::encode($new_values);
    }

    // END Getters and setters


    // Public methods

    // END Public methods


    // Public static methods

    /**
     * @param StoryInterface $object
     * @return bool
     */
    public static function write(StoryInterface $object)
    {
        $newStory = new self();

        $newStory->targetID = $object->getID();
        $newStory->targetClass = $object::className();
        $newStory->action = $object->getStoryAction();
        if ($fields = $object->getStoryFields()) {
            $newStory->fields = $fields;
        }
        if ($oldValues = $object->getStoryOldValues()) {
            $newStory->oldValues = $oldValues;
        }
        if ($newValues = $object->getStoryNewValues()) {
            $newStory->newValues = $newValues;
        }

        return $newStory->save();
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
