<?php

namespace models;

use Yii;
use abstracts\ModelAbstract;
use yii\db\Query;

/**
 * This is the model class for table "user_click".
 *
 * @property integer $userID
 * @property string $ipAddress
 * @property string $entityClass
 * @property integer $entityID
 * @property string $type
 *
 * @property User $user
 */
class UserClick extends ModelAbstract
{
    const TYPE_INTEREST = 'interesting';
    const TYPE_LIKE = 'like';

    private static $_types = [
        self::TYPE_INTEREST,
        self::TYPE_LIKE,
    ];

    public static function tableName()
    {
        return 'user_click';
    }

    public function rules()
    {
        return [
            [['userID', 'entityID'], 'integer'],
            [['userID', 'ipAddress', 'entityClass', 'entityID', 'type'], 'required'],
            [['entityClass'], 'string', 'max' => 126],
            [['ipAddress'], 'string', 'max' => 15],
            ['type', 'in', 'range' => self::$_types],
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
     * @return \yii\db\ActiveQuery
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

        $user = Yii::$app->user;
        if (!$this->userID && !$user->isGuest) {
            $this->userID = $user->id;
        }
        if (!$this->ip) {
            $this->ipAddress = $user->ipAddress;
        }

        return true;
    }

    // END Event handlers


    // Getters and setters

    // userID
    public function getUserID()
    {
        return $this->user_id;
    }
    public function setUserID($user_id)
    {
        $this->user_id = $user_id;
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

    // entityID
    public function getEntityID()
    {
        return $this->entity_id;
    }
    public function setEntityID($entity_id)
    {
        $this->entity_id = $entity_id;
    }

    //ipAddress
    public function getIpAddress()
    {
        return $this->ip_address;
    }
    public function setIpAddress($ip_address)
    {
        $this->ip_address = $ip_address;
    }

    // END Getters and setters


    // Public methods

    // END Public methods


    // Public static methods

    /**
     * Return click count for entity
     *
     * @param string $type
     * @param string $entityClass
     * @param integer $entityID
     * @param integer $userID
     * @return int
     */
    public static function count($type, $entityClass, $entityID, $userID = 0)
    {
        if (!in_array($type, self::$_types)) {
            return 0;
        }

        $conditions = [
            'entity_class' => $entityClass,
            'entity_id' => $entityID,
            'type' => $type,
        ];

        if ($userID === 0) {
            $user = Yii::$app->user;
            if ($user->isGuest) {
                $conditions['ip_address'] = $user->ipAddress;
            } else {
                $conditions['user_id'] = $user->id;
            }
        } elseif ($userID !== null) {
            $conditions['user_id'] = $userID;
        }

        return self::getCount($conditions);
    }

    /**
     * Make user click
     *
     * @param string $type
     * @param string $entityClass
     * @param integer $entityID
     * @return bool
     */
    public static function click($type, $entityClass, $entityID)
    {
        if (!in_array($type, self::$_types)) {
            return false;
        }
        $count = self::count($type, $entityClass, $entityID);

        $conditions = [
            'entity_class' => $entityClass,
            'entity_id' => $entityID,
            'type' => $type,
        ];
        $user = Yii::$app->user;
        if ($user->isGuest) {
            $conditions['ip_address'] = $user->ipAddress;
        } else {
            $conditions['user_id'] = $user->id;
        }

        if ($count > 0) {
            return (bool)Yii::$app->db->createCommand()->delete(self::tableName(), $conditions)->execute();
        } else {
            $conditions['ip_address'] = $user->ipAddress;
            return (bool)Yii::$app->db->createCommand()->insert(self::tableName(), $conditions)->execute();
        }
    }

    public static function getUsersNames($type, $entityClass, $entityID)
    {
        if (!in_array($type, self::$_types)) {
            return [];
        }
        $clicksCommand = (new Query())
            ->select('user_id')
            ->from(self::tableName())
            ->where([
                'entity_class' => $entityClass,
                'entity_id' => $entityID,
                'type' => $type,
            ])
            ->createCommand();

        $names = [];
        $users = (new Query())
            ->select(['name' => "CONCAT_WS(' ', first_name, last_name)"])
            ->from(User::tableName())
            ->where("id IN({$clicksCommand->sql})")
            ->addParams($clicksCommand->params)
            ->all();
        foreach ($users as $user) {
            $names[] = $user['name'];
        }
        return $names;
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
