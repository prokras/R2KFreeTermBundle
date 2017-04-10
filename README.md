1. Download ```
to src\R2K\FreeTermBundle

```
2. install google api client
    composer require google/apiclient:^2.0
    https://github.com/google/google-api-php-client
2. Register bundle in AppKernel
3. Rename config.yml.dis to config.yml in R2K\FreeTermBundle\Resources\config
4. Set parameters in config.yml:
    google_api_cred and google_calendar_id according to your specification

5. Copy your google account key to Resource/credentials
6. Optional asset:install
8. Place {{ render_terms(terms) }} in your template to render terms
7. Example:

/**
 * @Route("/test", name="test")
 */
public function testAction()
{
    $credentials = $this->getParameter('google_api_cred');
    $calendarId = $this->getParameter('google_calendar_id');
    $calendar = new GoogleCalendarApi($credentials, $calendarId, 'Google Calendar Terms');

    $builder = new TermBuilder($calendar);


    return $this->render('R2KFreeTermBundle:term:index.html.twig', [
        'terms' => $builder->getFree(),

    ]);

}
