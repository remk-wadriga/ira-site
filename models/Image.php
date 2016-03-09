<?php

namespace models;

use Yii;
use abstracts\ModelAbstract;
use interfaces\ImagedEntityInterface;
use yii\db\Query;

/**
 * This is the model class for table "image".
 *
 * @property integer $id
 * @property string $url
 * @property string $alt
 * @property string $status
 * @property string $description
 * @property string $dateAdd
 */
class Image extends ModelAbstract
{
    public static function tableName()
    {
        return 'image';
    }

    public static function entityImageTableName()
    {
        return 'entity_image';
    }

    public function rules()
    {
        return [
            [['url', 'dateAdd'], 'required'],
            [['status', 'description'], 'string'],
            [['dateAdd'], 'safe'],
            [['url'], 'string', 'max' => 512],
            [['alt'], 'string', 'max' => 255]
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

    public function beforeValidate()
    {
        if (!parent::beforeValidate()) {
            return false;
        }

        if (!$this->dateAdd) {
            $this->dateAdd = Yii::$app->time->getCurrentDateTime();
        }

        return true;
    }

    // END Event handlers


    // Getters and setters

    // dateAdd
    public function getDateAdd()
    {
        return $this->date_add;
    }
    public function setDateAdd($date_add)
    {
        $this->date_add = $date_add;
    }

    // END Getters and setters


    // Public methods

    // END Public methods


    // Public static methods

    /**
     * Creating|updating image (with entity_image related table) for entity
     *
     * @param ImagedEntityInterface $entity
     * @return bool
     * @throws \yii\db\Exception
     */
    public static function createImage(ImagedEntityInterface $entity)
    {
        $image = self::findEntityMainImage($entity);
        if ($image === null) {
            $image = new self();
        }

        $isNew = $image->getIsNewRecord();

        $image->url = $entity->getImgUrl();
        $image->alt = $entity->getImgAlt();

        $db = Yii::$app->getDb();
        $transaction = $db->beginTransaction();

        if (!$image->save()) {
            $transaction->rollBack();
            return false;
        }

        if ($isNew) {
            $params = [
                'entity_id' => $entity->getID(),
                'image_id' => $image->id,
                'entity_class' => $entity::className(),
                'is_main' => $entity->isMainImage(),
            ];
            $result = $db->createCommand()->insert(self::entityImageTableName(), $params)->execute() > 0;
            if (!$result) {
                $transaction->rollBack();
                return false;
            }
        } else {
            $params = [
                'entity_class' => $entity::className(),
                'is_main' => $entity->isMainImage(),
            ];
            $conditions = [
                'entity_id' => $entity->getID(),
                'image_id' => $image->id,
            ];
            $db->createCommand()->update(self::entityImageTableName(), $params, $conditions)->execute();
        }

        $transaction->commit();
        return true;
    }

    /**
     * Find the Entity main image model
     *
     * @param ImagedEntityInterface $entity
     * @return Image|null
     */
    public static function findEntityMainImage(ImagedEntityInterface $entity)
    {
        if ($entity->getImageID() > 0) {
            return self::findOne($entity->getImageID());
        } else {
            $command = (new Query())
                ->select('image_id')
                ->from(self::entityImageTableName())
                ->where([
                    'entity_id' => $entity->getID(),
                    'entity_class' => $entity::className(),
                    'is_main' => 1,
                ])
                ->createCommand();

            $sql = $command->sql;
            $params = $command->params;

            return self::find()
                ->where("id = ({$sql})")
                ->params($params)
                ->one();
        }
    }

    /**
     * Find all Entity images models
     *
     * @param ImagedEntityInterface $entity
     * @return Image[]
     */
    public static function findEntityImages(ImagedEntityInterface $entity)
    {
        if ($entity->getImageID() > 0) {
            return self::findAll($entity->getImageID());
        } else {
            $command = (new Query())
                ->select('image_id')
                ->from(self::entityImageTableName())
                ->where([
                    'entity_id' => $entity->getID(),
                    'entity_class' => $entity::className(),
                ])
                ->createCommand();

            $sql = $command->sql;
            $params = $command->params;

            return self::find()
                ->where("id IN({$sql})")
                ->params($params)
                ->all();
        }
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