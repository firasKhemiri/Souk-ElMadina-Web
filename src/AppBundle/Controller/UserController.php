<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Avis;
use AppBundle\Entity\User;
use AppBundle\Entity\Vendeur;
use FOS\UserBundle\Controller\SecurityController;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{

    public function userProfileAction()
    {

     /*   $user = new User();
        $user->getBirthday()
       */
        if ($this->container->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY'))
        {

            $user = $this->get('security.token_storage')->getToken()->getUser();

            return $this->render('@App/Profile/profileUser.html.twig', array('user'=>$user ));
        }

        else
            $sec = new SecurityController();
            return $sec->loginAction();
    }





    public function AllVendeursAction()
    {
        $user = new User();

        if ($this->container->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {
            $user = $this->get('security.token_storage')->getToken()->getUser();

        }
        return $this->render('@App/articles/allvendeurs.html.twig', array('user'=>$user ));
    }




    public function singleUserAction(Request $request)
    {

        $id = $request->get("id");

        $em = $this->container->get('doctrine')->getManager();

        $user = $em->getRepository('AppBundle:User')->find($id);

        $userme = new User();

        if ($this->container->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {
            $userme = $this->get('security.token_storage')->getToken()->getUser();

        }

        return $this->render('@App/articles/detailsarticle.html.twig', array('user' => $user,'userme'=>$userme));
    }





    public function filterBoutsAction(Request $request)
    {
        $page = $request->get("page");
        $nom_bout = $request->get("nom_bout");
        $gov = $request->get("gov");
        $notemax = $request->get("notemax");
        $notemin = $request->get("notemin");
        $type_tri = $request->get("type_tri");
        //    $abon = $request->get("abon");

        $limit = 12;


        $em = $this->container->get('doctrine')->getManager();

        $vendeurs = $em->getRepository('AppBundle:Vendeur')->filterBouts($page, $nom_bout, $gov,$type_tri,$notemin,$notemax);

        $totalPosts = sizeof($vendeurs);

        $pages = ceil($totalPosts / $limit);

        $i = 0;
        foreach ($vendeurs as $vendeur) {

            $img = "";

         //   $vendeur = new Vendeur();

            if ($vendeur->getUser()->getPhotoProf() != null && $vendeur->getUser()->getPhotoProf() != "") {
                $img = $vendeur->getUser()->getPhotoProf();
            }

                $res[] = array("id" => $vendeur->getId(), "name" => $vendeur->getNomBoutique(), "desc" => $vendeur->getDescription(),
                    "note" => $vendeur->getNote(), "type" => $vendeur->getType(), "img" => $img,);
                $responses = $res;
                $i++;
            }


        $fresponse = array("nbrc" => $i, "pages" => $pages);
        if ($i > 0)
            $fresponse += $responses;

        return new Response(json_encode($fresponse));

    }





}
