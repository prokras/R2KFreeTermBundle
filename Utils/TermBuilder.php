<?php

namespace R2K\FreeTermBundle\Utils;


class TermBuilder
{
    private $calendar;
    
    private $dateTime;
    
    private $periond;
    
    
    public function __construct(GoogleCalendarApi $calendar)
    {
        $this->calendar = $calendar;
        $this->dateTime = new \DateTime();
        $this->dateTime->setTimezone(new \DateTimeZone('Europe/Warsaw'));
        
        $this->setPeriod('P4W');
    }
    
    /**
     * Return array of free dates
     * @return string[]
     */
    public function getFree()
    {
        
        $datePeriod = $this->getPeriod();
        $busyDates = $this->getBusy();
        $freeDates = [];

        foreach ($datePeriod as $date) {
            if ($date->format('N') < 6 && !in_array($date->format('Y-m-d'), $busyDates)) {
                $freeDates[] = $date->format('Y-m-d:  l'); 
            }
        }
        return $freeDates;
    }
    
    /**
     * Return array of busy dates
     * @return string[]
     */
    public function getBusy()
    {
        
        $events = $this->calendar->fetchFromDate($this->dateTime->format('c'));
        $busyDates = [];
        foreach ($events as $event) {
            
            $busyDate = !empty($event->start->dateTime) ? $event->start->dateTime : $event->start->date;
            $busyDates[] = substr($busyDate, 0, 10);
        }
        return $busyDates;
    }
    
    /**
     * Set period range from today to specify params
     * @param string $periodInterval
     */
    public function setPeriod($periodInterval)
    {
        $begin = new \DateTime();
        $end = new \DateTime();
        $end->add(new \DateInterval($periodInterval));
        $interval = new \DateInterval('P1D');
        $this->periond = new \DatePeriod($begin, $interval, $end);
    }
    
    /**
     * 
     * @return \DatePeriod
     */
    public function getPeriod()
    {
        return $this->periond;
    }
}











