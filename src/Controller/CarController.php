<?php

namespace App\Controller;

use App\Entity\Car;
use App\Repository\CarRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class CarController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(ManagerRegistry $doctrine): Response
    {

        $allCars = $doctrine->getRepository(Car::class)->findAllCars();

        return $this->render('main/home.html.twig', [
            'controller_name' => 'CarController',
            'allCars' => $allCars,
        ]);
    }
}
