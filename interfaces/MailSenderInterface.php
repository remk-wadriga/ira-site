<?php
/**
 * Created by PhpStorm.
 * User: Rem
 * Date: 07.09.2016
 * Time: 13:01
 */

namespace interfaces;


interface MailSenderInterface
{
    /**
     * @return string
     */
    public function getMailFrom();

    /**
     * @return string
     */
    public function getMailTo();

    /**
     * @return string
     */
    public function getMailView();

    /**
     * @return string
     */
    public function getMailTitle();

    /**
     * @return string
     */
    public function getMailMessage();

    /**
     * @return array
     */
    public function getMailParams();

    /**
     * @return string
     */
    public function getUnfollowUrl();
}