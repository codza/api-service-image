<?php

namespace Extia\ServiceImageBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('ServiceImageBundle:Default:index.html.twig');
    }
}
