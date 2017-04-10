Bundles connects with google calendar api and displays dates without event for period
four weeks from current date, weekends excluded

Installation
============
1. Download or pull code to namespace R2K\FreeTermBundle
2. Install google api client https://github.com/google/google-api-php-client
    composer require google/apiclient:^2.0
3. Register bundle in AppKernel
        ```php
        <?php
        // app/AppKernel.php

        // ...
        class AppKernel extends Kernel
        {
            public function registerBundles()
            {
                $bundles = array(
                    // ...

                    new R2K\FreeTermBundle\R2KFreeTermBundle(),
                );

                // ...
            }

            // ...
        }
        ```
4. In R2K\FreeTermBundle\Resources\config
    a) Rename config.yml.dis to config.yml
    b) Set parameters in config.yml:
        - google_api_cred: path to your api json key
        - google_calendar_id: your google calendar id
        - google_app_name: application name, name it whatever you want
5. Copy your google account key file to Resource/credentials
6. (Optional) asset:install
8. Place {{ render_terms() }} in your template to render terms
7. Controller example, test usage:
        ```
        /**
         * @Route("/test", name="test")
         */
        public function testAction()
        {
            return $this->render('R2KFreeTermBundle:term:index.html.twig');
        }
        ```

Google Calendar Setup
=====================
1. Go to google api console https://console.developers.google.com
2. Create credential service account key, download json file
4. In google calendar share setting add user, use service account ID
