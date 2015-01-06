<?php

namespace itaw\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * @author Florian Weber <florian.weber.dd@icloud.com>
 */
class PageController extends Controller
{
    public function indexAction()
    {
        $endpoints = array();

        return $this->render('Page/status.html.twig', array(
                    'endpoints' => $endpoints,
        ));
    }
}
