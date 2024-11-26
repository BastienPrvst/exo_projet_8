<?php

namespace App\Controller;

use App\Entity\Car;
use App\Form\AddCarFormType;
use App\Repository\CarRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class CarController extends AbstractController
{

    private EntityManagerInterface $em;

    public function __construct(private readonly CarRepository $carRepository, EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    #[Route('/', name: 'app_home')]
    public function index(): Response
    {

        $allCars = $this->carRepository->findAllCars();

        return $this->render('main/home.html.twig', [
            'controller_name' => 'CarController',
            'allCars' => $allCars,
        ]);
    }

    #[Route('/car/{id}', name: 'app_car_show', requirements: ['id' => '\d+'])]
    public function show(Car $car): Response
    {
        return $this->render('main/show.html.twig', [
            'car' => $car,
        ]);
    }

    #[Route('/car/{id}/remove', name: 'app_car_remove')]
    public function remove(Car $car): Response
    {
        $carToDelete = $this->carRepository->findCarById($car->getId());
        if ($carToDelete) {
        $this->em->remove($car);
        $this->em->flush();
        }
        return $this->redirectToRoute('app_home');
    }

    #[Route('/car/add', name: 'app_car_add')]
    public function add(Request $request): Response
    {
        $car = new Car();

        $form = $this->createForm(AddCarFormType::class, $car);

        $form->handleRequest($request);

        if ($form->isSubmitted() ){
            $this->em->persist($car);
            $this->em->flush();
            return $this->redirectToRoute('app_home');
        }

        return $this->render('main/add.html.twig', [
            'form' => $form,
        ]);

    }
}
