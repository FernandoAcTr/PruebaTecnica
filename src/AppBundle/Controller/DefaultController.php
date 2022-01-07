<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="home")
     */
    public function indexAction(Request $request)
    {
        return $this->render('index.html.twig');
    }

    /**
     * @Route("/create", name="create")
     */
    public function createAction(Request $request)
    {
        return $this->render('create.html.twig');
    }

    /**
     * @Route("/edit", name="edit")
     */
    public function editAction(Request $request)
    {
        return $this->render('edit.html.twig');
    }
}
