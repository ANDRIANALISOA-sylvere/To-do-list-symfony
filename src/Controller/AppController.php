<?php

namespace App\Controller;

use App\Entity\Tache;
use App\Form\TacheType;
use App\Entity\SousTache;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AppController extends AbstractController
{
    #[Route('/app', name: 'app_app')]
    public function index(\Doctrine\Persistence\ManagerRegistry $manager, Request $request): Response
    {
        $tache = new Tache();
        $form = $this->createForm(TacheType::class, $tache);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $tache = $form->getData();
            $em = $manager->getManager();

            $em->persist($tache);
            $em->flush();

            $this->addFlash(
                'success',
                'Votre tache a été ajouter avec succès'
            );

            return $this->redirectToRoute('app_app');
        }
        $liste = $manager->getRepository(Tache::class)->findBy([], ['id' => 'DESC']);
        $listesoustache = $manager->getRepository(SousTache::class)->findAll();
        return $this->render('app/index.html.twig', [
            'tache' => $form->createView(),
            'taches' => $liste,
            'soustaches' => $listesoustache,
        ]);
    }
    #[Route('/removetache/{id}', name: 'app_remove')]
    public function removetache($id, ManagerRegistry $manager): Response
    {
        $tache = $manager->getRepository(Tache::class)->findOneBy(['id' => $id]);
        $em = $manager->getManager();
        $em->remove($tache);
        $em->flush();
        return $this->redirectToRoute('app_app');
    }
}