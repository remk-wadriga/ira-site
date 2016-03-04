<?php
/**
 * Created by PhpStorm.
 * User: Dima
 * Date: 04.03.2016
 * Time: 14:30
 */

namespace models;

use abstracts\ModelAbstract;
use interfaces\IdentityInterface;

class User extends ModelAbstract implements IdentityInterface
{
    public static function tableName()
    {
        return 'table_name';
    }

    public function rules()
    {
        return [

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

    // END Getters and setters


    // Public methods

    // END Public methods


    // Public static methods

    // END Public static methods


    // Protected methods

    // END Protected methods


    // Protected static methods

    // END Protected static methods


    // Private methods

    // END Private methods


    // Private static methods

    // END Private static methods


    // Implements IdentityInterface

    /**
     * @param int|string $id
     * @return null|User
     */
    public static function findIdentity($id)
    {
        return self::findOne($id);
    }

    /**
     * @param string $token
     * @param string $type
     * @return null|User
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return null;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getAuthKey()
    {
        return null;
    }

    public function validateAuthKey($authKey)
    {
        return false;
    }

    // END Implements IdentityInterface
}