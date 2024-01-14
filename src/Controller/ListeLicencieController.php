<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\CategoriesRepository;
use App\Repository\LicenciesRepository;
use App\Repository\ContactsRepository;
use Symfony\Component\HttpFoundation\Request;

class ListeLicencieController extends AbstractController
{
    #[Route('/liste/licencie/{entite}', name: 'app_liste_licencie',methods: ['GET'])]
    
    public function index(CategoriesRepository $categoriesRepository,Request $request): Response
    {
      
      
      $categories = $categoriesRepository->findAllCategorie();
      $entite = $request->get('entite');
      
      //$user = $this->getUser();
     // var_dump($user);
   //   die();
      
     
        return $this->render('liste_licencie/index.html.twig', [
            'controller_name' => 'ListeLicencieController',
            'categories' => $categories,
            'entite' => $entite,

        ]);

    }


    #[Route('{id}/liste_categorie_licencie', name: 'app_liste_licencie_categorie')]
    
    public function licenciecategorie(LicenciesRepository $LicenciesRepository,CategoriesRepository $categoriesRepository,int $id): Response
    {
        
      
      $licenciescategories = $LicenciesRepository->findAllLicencieCategorie($id);

      $categorie = $categoriesRepository->findOneCategorie($id);
      
      if(count($categorie)>0)
      {
        $libellecategorie=$categorie[0]['nom'];
      }
      
       
      
        return $this->render('liste_licencie/listelicenciecategorie.html.twig', [
            'controller_name' => 'ListeLicencieController',
            'licenciescategories' => $licenciescategories,
            'libellecategorie' => $libellecategorie,

        ]);
    }


    #[Route('{id}/liste_categorie_contact', name: 'app_liste_contacts_categorie')]
    
    public function contactscategorie(ContactsRepository $ContactsRepository,CategoriesRepository $categoriesRepository,int $id): Response
    {
        
      
      $contactscategories = $ContactsRepository->findAllContactsCategorie($id);

      $categorie = $categoriesRepository->findOneCategorie($id);
      
      if(count($categorie)>0)
      {
        $libellecategorie=$categorie[0]['nom'];
      }
      
       
        return $this->render('liste_licencie/listecontactscategorie.html.twig', [
            'controller_name' => 'ListeLicencieController',
            'contactscategories' => $contactscategories,
            'libellecategorie' => $libellecategorie,

        ]);
    }






}
