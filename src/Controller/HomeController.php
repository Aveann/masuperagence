<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

use App\Repository\PropertyRepository;

use Twig\Environment;

class HomeController extends AbstractController
{
    private $twig;

    public function __construct(Environment $twig)
    {
        $this->twig = $twig;
    }

    public function index(PropertyRepository $property) : Response
    {
        $properties = $property->findLatest();
        return new Response($this->twig->render('home/index.html.twig', [
            'properties' => $properties,
        ]
        ));
    }
}
