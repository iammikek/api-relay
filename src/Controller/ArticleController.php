<?php

namespace App\Controller;

use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use FOS\RestBundle\View\View;
use FOS\RestBundle\Controller\Annotations as FOSRest;

/**
 * Brand controller.
 *
 */
class ArticleController extends Controller
{

    /**
     * @Route("/")
     */
    public function homepage()
    {
        $title = "A U T O M I C A";
        $body = '';

        return $this->render('article/show.html.twig', [
            'title' => ucwords(str_replace('-', ' ', $title)),
            'body' => $body
        ]);

    }

    /**
     * @Route("/api")
     */
    public function api()
    {
        return new Response('A U T O M I C A . A P I');
    }
}