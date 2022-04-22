<?php

namespace App\Controller;

use App\Entity\Property;

use App\Repository\PropertyRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\EntityManagerInterface;

class PropertyController extends AbstractController
{
    /**
    * @var PropertyRepository
    */
    private $repository;

    /**
    * @var EntityManagerInterface
    */
    private $entityManager;

    public function __construct(PropertyRepository $repository, EntityManagerInterface $entityManager){
        $this->repository = $repository;
        $this->entityManager = $entityManager;
    }

    ##[Route('/logements', name: 'property.index')]
    public function index(ManagerRegistry $doctrine): Response
    {
      return $this->render('property/index.html.twig', [
          'controller_name' => 'PropertyController',
          'current_menu' => 'properties'
      ]);
    }

    public function show(Property $property, string $slug): Response {
        if ($property->getSlug() !== $slug){
            return $this->redirectToRoute('property.show', [
                'id' => $property->getId(),
                'slug' => $property->getSlug(),
            ], status: 301);
        }
        return $this->render('property/show.html.twig', [
            'property' => $property,
        ]
        );
    }
}
