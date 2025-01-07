<?php

namespace App\Controller;

use App\Entity\Employe;
use App\Form\EmployeType;
use App\Repository\EmployeRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class EmployeController extends AbstractController
{
    #[Route('/employe', name: 'app_employe')]
    public function index(EmployeRepository $employeRepository): Response
    {
        
        $employes = $employeRepository->findBy([], ['nom' => 'ASC']);
        return $this->render('employe/index.html.twig', [
            'employes' => $employes,
            'description' => 'Liste des employés'
        ]);
    }

    #[Route('/employe/new', name: 'new_employe')]
    public function new(Request $request): Response
    {
        $employe = new Employe();

        $form = $this->createForm(EmployeType::class, $employe);

        return $this->render('employe/new.html.twig', [
            'formAddEmploye' => $form,
            'description' => 'Création d’une nouvelle employé'
        ]);
    }

    #[Route('/employe/{id}', name: 'show_employe')]
    public function show(Employe $employe): Response
    {
        return $this->render('employe/show.html.twig', [
            'employe' => $employe,
            'description' => 'Détail de l’employé : '.$employe
        ]);
    }

}
