<?php

namespace R2K\FreeTermBundle\Utils;

/**
 * Establish connection wiht Google Calendar API
 * Provides method to retrieves data from calendar
 * 
 * @author R2Kode
 *
 */
class GoogleCalendarApi
{
    private $credentials;
    
    private $calendarId;
    
    private $service;
    
    /**
     * 
     * @param string $credentials
     * @param string $calendarId
     * @param string $appName
     */
    public function __construct($credentials, $calendarId, $appName)
    {
        $this->calendarId = $calendarId;
        
        $this->client = new \Google_Client();
        $this->client->setApplicationName($appName);
        $this->client->setScopes(\Google_Service_Calendar::CALENDAR_READONLY);
        $this->client->setAuthConfig($credentials);
        
        $this->service = new \Google_Service_Calendar($this->client);
    }
    
    /**
     * Retrieves events as object
     * 
     * @return Google_Service_Calendar_Events
     */
    public function fetchTerms()
    {
        return $this->service->events->listEvents($this->calendarId);
    }
    
    /**
     * Retrieves events from timeMin
     * 
     * @param string $startDate
     * @return Google_Service_Calendar_Events
     */
    public function fetchFromDate($startDate)
    {
        return $this->service->events->listEvents($this->calendarId, [
            'timeMin' => $startDate,
        ]);
    }
    
}

















