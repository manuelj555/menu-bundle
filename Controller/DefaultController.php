<?php

namespace KuManuel\Bundle\MenuBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('KuMenuBundle:Default:index.html.twig', array(
            
        ));
    }
}
