<?php

namespace itaw\BackendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * @author Florian Weber <florian.weber.dd@icloud.com>
 */
class PageController extends Controller
{
    public function dashboardAction()
    {
        return $this->render('itawBackendBundle:Page:dashboard.html.twig');
    }
}
