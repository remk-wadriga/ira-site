<?php
/**
 * Created by PhpStorm.
 * User: Dima
 * Date: 05.03.2016
 * Time: 16:44
 */

namespace components;

use Yii;
use yii\base\Component;

class TimeService extends Component
{
    protected static $_deyNames = [
        0 => 'Sunday',
        1 => 'Monday',
        2 => 'Tuesday',
        3 => 'Wednesday',
        4 => 'Thursday',
        5 => 'Friday',
        6 => 'Saturday',
    ];

    public $dateTimeFormat;
    public $dateFormat;
    public $timeFormat;

    public function init()
    {
        if ($this->dateTimeFormat === null) {
            $this->dateTimeFormat = Yii::$app->params['datetimeFormat'];
        }
        if ($this->dateFormat === null) {
            $this->dateFormat = Yii::$app->params['dateFormat'];
        }
        if ($this->timeFormat === null) {
            $this->timeFormat = Yii::$app->params['timeFormat'];
        }
    }

    public function formatDate($date, $format = null)
    {
        if ($format === null) {
            $format = $this->dateFormat;
        }

        return $this->getDateTime($date)->format($format);
    }

    public function formatTime($date, $format = null)
    {
        if ($format === null) {
            $format = $this->timeFormat;
        }
        return $this->getDateTime($date)->format($format);
    }

    public function formatDateTime($date, $format = null)
    {
        if ($format === null) {
            $format = $this->dateTimeFormat;
        }

        return $this->getDateTime($date)->format($format);
    }

    public function getCurrentDateTime($format = null)
    {
        if ($format === null) {
            $format = $this->dateTimeFormat;
        }

        return $this->getDateTime()->format($format);
    }

    public function getCurrentDate($format = null)
    {
        if ($format === null) {
            $format = $this->dateFormat;
        }

        return $this->getDateTime()->format($format);
    }

    public function getFrontendDateTime($date = null)
    {
        $date = $date === null ? $this->getDateTime() : $this->getDateTime($date);

        return $date->format(Yii::$app->params['api_datetime_format']);
    }

    public function addSeconds($interval, $time = null, $format = null)
    {
        if ($format === null) {
            $format = $this->dateTimeFormat;
        }

        if ($time === null) {
            $time = $this->getCurrentDateTime();
        }

        $dateInterval = $this->getDateInterval($time);
        $dateInterval->s = $interval;

        return $this->getDateTime($time)->add($dateInterval)->format($format);
    }

    public function dbFormat($time = 'now')
    {
        return $this->getDateTime($time)->format($this->dateTimeFormat);
    }

    public function getDey($time = 'now')
    {
        return (int)$this->getDateTime($time)->format('w');
    }

    public function getDeyName($time = 'now')
    {
        return self::$_deyNames[$this->getDateTime($time)->format('w')];
    }

    public function getDeyNameBayNumber($dayNumber)
    {
        return isset(self::$_deyNames[$dayNumber]) ? self::$_deyNames[$dayNumber] : self::$_deyNames[0];
    }

    public function getNextDayDate($time = null, $format = null)
    {
        if ($format === null) {
            $format = $this->dateFormat;
        }

        return $this->addSeconds(24*3600, $time, $format);
    }

    public function toDays($seconds)
    {
        $dtF = $this->getDateTime("@0");
        $dtT = $this->getDateTime("@$seconds");
        return $dtF->diff($dtT)->format('%a');
    }

    public function getFirstMonthDate($date = 'now', $format = null)
    {
        if ($format === null) {
            $format = $this->dateFormat;
        }
        return $this->getDateTime($date)->modify('first day of this month')->format($format);
    }

    public function getLastMonthDate($date = 'now', $format = null)
    {
        if ($format === null) {
            $format = $this->dateFormat;
        }
        return $this->getDateTime($date)->modify('last day of this month')->format($format);
    }

    public function getFirstWeekDate($date = 'now', $format = null)
    {
        if ($format === null) {
            $format = $this->dateFormat;
        }
        return $this->getDateTime($date)->modify('Monday this week')->format($format);
    }

    public function getLastWeekDate($date = 'now', $format = null)
    {
        if ($format === null) {
            $format = $this->dateFormat;
        }
        return $this->getDateTime($date)->modify('Sunday this week')->format($format);
    }

    /**
     * @param string $time
     * @return \DateTime
     */
    protected function getDateTime($time = 'now')
    {
        $time = str_replace('.', '-', $time);
        return new \DateTime($time);
    }

    /**
     * @param string $time
     * @return \DateInterval
     */
    protected function getDateInterval($time = null)
    {
        if ($time === null) {
            $time = $this->getCurrentDateTime();
        }

        return \DateInterval::createFromDateString($time);
    }
}