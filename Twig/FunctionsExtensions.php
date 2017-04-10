<?php

namespace R2K\FreeTermBundle\Twig;

/**
 * 
 * @author R2Kode
 *
 */
class FunctionsExtensions extends \Twig_Extension
{
    
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
        return $environment->render('R2KFreeTermBundle:term:terms.html.twig', [
            'terms' => $terms,
        ]);
    }
    
    public function getName()
    {
        return 'FunctionsExtensions';
    }
}