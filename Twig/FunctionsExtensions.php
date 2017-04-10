<?php

namespace R2K\FreeTermBundle\Twig;

use R2K\FreeTermBundle\Utils\GoogleCalendarApi;
use R2K\FreeTermBundle\Utils\TermBuilder;

/**
 * 
 * @author R2Kode
 *
 */
class FunctionsExtensions extends \Twig_Extension
{
    
    private $credentials;
    
    private $calendarId;
    
    private $googleAppName;
    
    public function __construct($google_api_cred, $google_calendar_id, $google_app_name)
    {
        $this->credentials = $google_api_cred;
        $this->calendarId = $google_calendar_id;
        $this->googleAppName = $google_app_name;
    }
    
    public function getFunctions()
    {
        return array(
            new \Twig_SimpleFunction('render_terms', array($this, 'renderTerms'), array(
                'is_safe' => ['html'],
                'needs_environment' => true
            )),
        );
    }
    
    /**
     * 
     * @param \Twig_Environment $environment
     * @param array $terms
     * @return string
     */
    public function renderTerms(\Twig_Environment $environment, array $terms = array())
    {

        $calendar = new GoogleCalendarApi($this->credentials, $this->calendarId, $this->googleAppName);
        
        $builder = new TermBuilder($calendar);
        
        return $environment->render('R2KFreeTermBundle:term:terms.html.twig', [
            'terms' => $builder->getFree(),
        ]);
    }
    
    public function getName()
    {
        return 'FunctionsExtensions';
    }
}