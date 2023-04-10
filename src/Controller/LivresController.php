<?php

namespace App\Controller;

use App\Entity\Livres;
use App\Repository\LivresRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LivresController extends AbstractController
{
    #[Route('admin/livres', name: 'app_admin_livres')]
    public function index(LivresRepository $rep): Response
    {  $livres=$rep->findAll();
        dd($livres);
    }
    #[Route('admin/livres/find/{id}', name: 'admin_livres_find_id')]
    public function chercher(Livres $livre): Response
    {
        dd($livre);
    }
    #[Route('admin/livres/add', name: 'admin_livres_add')]
    public function add(ManagerRegistry $doctrine): Response
    {
        $date=new \DateTime('2022-01-01');
        $livre =new Livres();
        $livre->setLibelle('Réseaux')
               ->setResume('resumé réseaux')
               ->setPrix(110)
               ->setImage('https://via.placeholder.com/300')
               ->setEditeur('Dunod');
        $livre->setDateEdition($date);
        $em=$doctrine->getManager();
        $em->persist($livre);
        $em->flush();
        dd($livre);
    }
    #[Route('admin/livres/update/{id}', name: 'admin_livres_update_id')]
    public function update(Livres $livre,ManagerRegistry $doctrine): Response
    {
        $livre->setPrix(120);
        $em=$doctrine->getManager();
        $em->flush();
        dd($livre);
    }
    #[Route('admin/livres/delete/{id}', name: 'admin_livres_delete_id')]
    public function delete(Livres $livre,ManagerRegistry $doctrine): Response
    {   $em=$doctrine->getManager();
        $em->remove($livre);
        $em->flush();
        dd('ok');
    }



}
