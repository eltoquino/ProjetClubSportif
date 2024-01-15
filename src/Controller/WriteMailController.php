<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\EducateursRepository;
use App\Repository\MaileduRepository;
use App\Repository\DetmaileduRepository;
use App\Repository\ContactsRepository;
use App\Repository\MailcontactsRepository;
use App\Repository\DetmailcontactsRepository;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Mailedu;
use App\Entity\Detmailedu;
use App\Entity\Mailcontacts;
use App\Entity\Detmailcontacts;
use Doctrine\ORM\EntityManagerInterface;

class WriteMailController extends AbstractController
{
    #[Route('/write/mail/{entite}', name: 'app_write_mail')]
    public function index(EducateursRepository $educateursRepository,ContactsRepository $ContactsRepository,Request $request): Response
    {
       $entite = $request->get('entite');
       //var_dump($entite);
       //die();
      $user = $this->getUser();
    
       $ideduc=$user->getId();
       if($entite=='educateur')
       {
        $educateurs = $educateursRepository->findAllEducateurOne($ideduc);
 
       }
       else{
        $educateurs = $ContactsRepository->findAllMailsContacts();
       }
        return $this->render('write_mail/index.html.twig', [
            'controller_name' => 'WriteMailController',
            'educateurs'=>$educateurs,
            'entite'=>$entite
        ]);
      
    }


    #[Route('/Consulter/mail/{entite}', name: 'app_view_mail')]
    public function consulterMail(Request $request,EntityManagerInterface $entityManager,DetmaileduRepository $DetmaileduRepository,MaileduRepository $MaileduRepository,MailcontactsRepository $MailcontactsRepository,DetmailcontactsRepository $DetmailcontactsRepository,EducateursRepository $educateursRepository): Response
    {
        $entite = $request->get('entite');
        $user = $this->getUser();
        $ideduc=$user->getId();

        if( $entite=='educateur') 
        {
            $boiteEnvoi = $MaileduRepository->findMailSend($ideduc);
        }
        else
        {
            
            $boiteEnvoi = $MailcontactsRepository->findMailSendContacts($ideduc);

        }

        return $this->render('write_mail/consulterMail.html.twig', [
            'controller_name' => 'WriteMailController',
            'boiteEnvois'=>$boiteEnvoi,
            'entite'=>$entite
        ]);
    }
   

    #[Route('/envoi/mail', name: 'app_envoi_mail',methods: ['GET','POST'])]
    public function envoimail(EntityManagerInterface $entityManager,DetmaileduRepository $DetmaileduRepository,MaileduRepository $MaileduRepository,MailcontactsRepository $MailcontactsRepository,DetmailcontactsRepository $DetmailcontactsRepository,EducateursRepository $educateursRepository,Request $request): Response
    {

        if ($request->getMethod() == 'POST') {
          $user = $this->getUser();
          $entite=$request->get('entite');

         if($request->get('entite')=='educateur') 
         {
       
         
          $Mailedu = new Mailedu();
          $Mailedu->setDateEnvoi(New \Datetime());
          $Mailedu->setObjet($request->get('objet'));
          $Mailedu->setMessage($request->get('message'));
          $Mailedu->setImportant(1);
          $Mailedu->setSupprimer(0);
          $Mailedu->setIdEducateurs($user->getId());
          $entityManager->persist($Mailedu);
           $entityManager->flush();
       
          $idInstant = $Mailedu->getId();

          $monTableauEduc=$request->get('educateur_id');
          $longueur = count($monTableauEduc);

    for ($i = 0; $i < $longueur; $i++) {
    
        $DetMaildetedu = new DetmailEdu();
        $DetMaildetedu->setIdMailedu($idInstant);
        $DetMaildetedu->setIdEducateurs($monTableauEduc[$i]);
        $DetMaildetedu->setSupprimer(0);

        $entityManager->persist($DetMaildetedu);
            $entityManager->flush();    
    }
          
    
        $ideduc=$user->getId();
        $boiteEnvoi = $MaileduRepository->findMailSend($ideduc);
        // $boiteDeReception = $DetmaileduRepository->findBoiteReception($ideduc);
        //var_dump($educateurs);
        //die();
        return $this->render('write_mail/consulterMail.html.twig', [
            'controller_name' => 'WriteMailController',
            'boiteEnvois'=>$boiteEnvoi,
            'entite'=>$entite
        ]);
        
    }
    else // Debut contacts
    {
        $Mailcontact = new Mailcontacts();
        $Mailcontact->setDateEnvoi(New \Datetime());
        $Mailcontact->setObjet($request->get('objet'));
        $Mailcontact->setMessage($request->get('message'));
        $Mailcontact->setImportant(1);
        $Mailcontact->setSupprimer(0);
        $Mailcontact->setIdEducateurs($user->getId());
        $entityManager->persist($Mailcontact);
         $entityManager->flush();
     
        $idInstant = $Mailcontact->getId();

        $monTableauEduc=$request->get('educateur_id');
        $longueur = count($monTableauEduc);

  for ($i = 0; $i < $longueur; $i++) {
  
      $Detmailcontacts = new Detmailcontacts();
      $Detmailcontacts->setIdMailcontact($idInstant);
      $Detmailcontacts->setIdContacts($monTableauEduc[$i]);
      $Detmailcontacts->setSupprimer(0);

      $entityManager->persist($Detmailcontacts);
          $entityManager->flush();    
  }
        
  
      $ideduc=$user->getId();
      $boiteEnvoi = $MailcontactsRepository->findMailSendContacts($ideduc);
      // $boiteDeReception = $DetmaileduRepository->findBoiteReception($ideduc);
      //var_dump($educateurs);
      //die();
      return $this->render('write_mail/consulterMail.html.twig', [
          'controller_name' => 'WriteMailController',
          'boiteEnvois'=>$boiteEnvoi,
          'entite'=>$entite
      ]);
      
  }
  }
    }


    #[Route('/detail/mail/{entite}/{id}', name: 'app_view_detail_mail')]
    public function detailMail(Request $request,EntityManagerInterface $entityManager,DetmaileduRepository $DetmaileduRepository,MaileduRepository $MaileduRepository,MailcontactsRepository $MailcontactsRepository,DetmailcontactsRepository $DetmailcontactsRepository,EducateursRepository $educateursRepository): Response
    {
        $entite = $request->get('entite');
        $id = $request->get('id');
       // var_dump($entite);
        //var_dump($id);
        //die();
        $user = $this->getUser();
        $ideduc=$user->getId();

        if( $entite=='educateur') 
        {
            $boiteEnvoi = $MaileduRepository->findOneMailSend($id);

            $boiteReception = $DetmaileduRepository->findBoiteReception($id);

            
        }
        else
        {
            
            $boiteEnvoi = $MailcontactsRepository->findOneMailSendContacts($id);
            $boiteReception = $DetmailcontactsRepository->findBoiteReception($id);

        }

        return $this->render('write_mail/detailMail.html.twig', [
            'controller_name' => 'WriteMailController',
            'boiteEnvois'=>$boiteEnvoi,
            'boiteReceptions'=>$boiteReception,
            'entite'=>$entite,
            'id'=>$id
        ]);
    }


    #[Route('/delete/mail', name: 'delete_envoi_mail',methods: ['GET','POST'])]
    public function deleteMail(EntityManagerInterface $entityManager,DetmaileduRepository $DetmaileduRepository,MaileduRepository $MaileduRepository,MailcontactsRepository $MailcontactsRepository,DetmailcontactsRepository $DetmailcontactsRepository,EducateursRepository $educateursRepository,Request $request): Response
    {

        if ($request->getMethod() == 'POST') {
          $user = $this->getUser();
          $entite=$request->get('entite');
          $id=$request->get('id');
         // var_dump($entite);
        //  var_dump( $id);
       

         if($request->get('entite')=='educateur') 
         {
            $mailEdu = $MaileduRepository->find($id);
           // var_dump($mailEdu);
            $mailEdu->setSupprimer(1);
            $entityManager->flush();  
            
            $ideduc=$user->getId();
          $boiteEnvoi = $MaileduRepository->findMailSend($ideduc);
       
         }
         else{
            $mailContacts = $MailcontactsRepository->find($id);
          //  var_dump($mailEdu);
            $mailContacts->setSupprimer(1);
            $entityManager->flush();  

            $ideduc=$user->getId();
            $boiteEnvoi = $MailcontactsRepository->findMailSendContacts($ideduc);

         }


     
         // $boiteDeReception = $DetmaileduRepository->findBoiteReception($ideduc);
         //var_dump($educateurs);
         //die();
         return $this->render('write_mail/consulterMail.html.twig', [
            'controller_name' => 'WriteMailController',
            'boiteEnvois'=>$boiteEnvoi,
            'entite'=>$entite
        ]);




        }
    }





    

}
