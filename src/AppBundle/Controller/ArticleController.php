<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Avis;
use AppBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ArticleController extends Controller
{


    public function accueilAction()
    {
        $user = new User();

        if ($this->container->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {
            $user = $this->get('security.token_storage')->getToken()->getUser();

        }

        return $this->render('@App/articles/index.html.twig', array('user' => $user));
    }

    public function AllArticlesAction()
    {
        $user = new User();

        if ($this->container->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {
            $user = $this->get('security.token_storage')->getToken()->getUser();

        }
        return $this->render('@App/articles/allarticles.html.twig', array('user' => $user));
    }


    public function userProfileAction()
    {

        if ($this->container->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {
            $user = $this->get('security.token_storage')->getToken()->getUser();

            return $this->render('@App/articles/profileUser.html.twig', array('user' => $user));
        } else
            return $this->render('@App/Security/newlogin.html.twig');
    }


    public function singleArticleAction(Request $request)
    {

        $id = $request->get("id");

        $em = $this->container->get('doctrine')->getManager();

        $article = $em->getRepository('AppBundle:Article')->find($id);

        $user = new User();

        if ($this->container->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {
            $user = $this->get('security.token_storage')->getToken()->getUser();

        }

        return $this->render('@App/articles/detailsarticle.html.twig', array('article' => $article, 'user' => $user));
    }


    public function getAllArtsAction()
    {
        $em = $this->container->get('doctrine')->getManager();

        $articles = $em->getRepository('AppBundle:Article')->findAll();

        $i = 0;
        foreach ($articles as $article) {

            $new = false;

            if (is_null($article->getOldprix()))
                $op = "";
            else
                $op = $article->getOldprix() . "DT";


            if (sizeof($article->getImages()) > 0) {

                $first = true;
                foreach ($article->getImages() as $image) {
                    if ($first) {
                        $img = $image->getUrl();
                        $first = false;
                    } else {
                        break;
                    }
                }

                $res[] = array("id" => $article->getId(), "name" => $article->getNom(), "desc" => $article->getDescription(),
                    "cat" => $article->getCategorie(), "date" => $article->getDatePub(), "img" => "/" . $img,
                    "prix" => $article->getPrix() . "DT", "oldprix" => $op, "new" => $new);
                $responses = $res;
                $i++;
            } else {
                $res[] = array("id" => $article->getId(), "name" => $article->getNom(), "desc" => $article->getDescription(),
                    "cat" => $article->getCategorie(), "date" => $article->getDatePub(), "img" => "/images/item-02.jpg",
                    "prix" => $article->getPrix() . "DT", "oldprix" => $op, "new" => $new);
                $responses = $res;
                $i++;
            }
        }

        $fresponse = array("nbrc" => $i);
        $fresponse += $responses;

        return new Response(json_encode($fresponse));
    }


    public function getFuturedArtsAction()
    {
        $em = $this->container->get('doctrine')->getManager();

        $articles = $em->getRepository('AppBundle:Article')->findAll();

        $i = 0;
        foreach ($articles as $article) {

            if (is_null($article->getOldprix()))
                $op = "";
            else
                $op = $article->getOldprix() . "DT";


            if (sizeof($article->getImages()) > 0) {

                $first = true;
                foreach ($article->getImages() as $image) {
                    if ($first) {
                        $img = $image->getUrl();
                        $first = false;
                    } else {
                        break;
                    }
                }

                $res[] = array("id" => $article->getId(), "name" => $article->getNom(), "desc" => $article->getDescription(),
                    "cat" => $article->getCategorie(), "date" => $article->getDatePub(), "img" => "/" . $img,
                    "prix" => $article->getPrix() . "DT", "oldprix" => $op);
                $responses = $res;
                $i++;
            } else {
                $res[] = array("id" => $article->getId(), "name" => $article->getNom(), "desc" => $article->getDescription(),
                    "cat" => $article->getCategorie(), "date" => $article->getDatePub(), "img" => "/images/item-02.jpg",
                    "prix" => $article->getPrix() . "DT", "oldprix" => $op);
                $responses = $res;
                $i++;
            }
        }

        $fresponse = array("nbrc" => $i);
        $fresponse += $responses;

        return new Response(json_encode($fresponse));

    }


    public function getCatsAction()
    {

        $em = $this->container->get('doctrine')->getManager();

        $categories = $em->getRepository('AppBundle:Categorie')->findAll();

        $i = 0;
        foreach ($categories as $cat) {

            $res[] = array("id" => $cat->getId(), "name" => $cat->getNom(), "desc" => $cat->getDescription(),
                "img" => $cat->getImage());
            $responses = $res;
            $i++;
        }

        $fresponse = array("nbrc" => $i);
        $fresponse += $responses;

        return new Response(json_encode($fresponse));

    }


    public function articlesPagerAction(Request $request)
    {
        $page = $request->get("page");

        $limit = 12;

        $em = $this->container->get('doctrine')->getManager();

        $articles = $em->getRepository('AppBundle:Article')->getAllPosts($page);

        $totalPosts = sizeof($articles);

        $pages = ceil($totalPosts / $limit);

        $i = 0;
        foreach ($articles as $article) {

            if (is_null($article->getOldprix()))
                $op = "";
            else
                $op = $article->getOldprix() . "DT";


            if (sizeof($article->getImages()) > 0) {

                $first = true;
                foreach ($article->getImages() as $image) {
                    if ($first) {
                        $img = $image->getUrl();
                        $first = false;
                    } else {
                        break;
                    }
                }

                $res[] = array("id" => $article->getId(), "name" => $article->getNom(), "desc" => $article->getDescription(),
                    "cat" => $article->getCategorie(), "date" => $article->getDatePub(), "img" => "/" . $img,
                    "prix" => $article->getPrix() . "DT", "oldprix" => $op);
                $responses = $res;
                $i++;
            } else {
                $res[] = array("id" => $article->getId(), "name" => $article->getNom(), "desc" => $article->getDescription(),
                    "cat" => $article->getCategorie(), "date" => $article->getDatePub(), "img" => "/images/item-02.jpg",
                    "prix" => $article->getPrix() . "DT", "oldprix" => $op);
                $responses = $res;
                $i++;
            }
        }


        $fresponse = array("nbrc" => $i, "pages" => $pages);
        $fresponse += $responses;

        return new Response(json_encode($fresponse));

    }


    public function filterArtsAction(Request $request)
    {
        $page = $request->get("page");
        $nom_art = $request->get("nom_art");
        $cats = $request->get("cats");
        $nom_bout = $request->get("nom_bout");
        $type_tri = $request->get("type_tri");
        $gov = $request->get("gov");
        $pmin = $request->get("pmin");
        $pmax = $request->get("pmax");
        //    $abon = $request->get("abon");

        $limit = 12;


        $em = $this->container->get('doctrine')->getManager();

        $articles = $em->getRepository('AppBundle:Article')->filterArts($page, $nom_art, $cats, $type_tri, $gov, $pmin, $pmax, '', $nom_bout);

        $totalPosts = sizeof($articles);

        $pages = ceil($totalPosts / $limit);

        $i = 0;
        foreach ($articles as $article) {

            if (is_null($article->getOldprix()))
                $op = "";
            else
                $op = $article->getOldprix() . "DT";


            if (sizeof($article->getImages()) > 0) {

                $first = true;
                foreach ($article->getImages() as $image) {
                    if ($first) {
                        $img = $image->getUrl();
                        $first = false;
                    } else {
                        break;
                    }
                }

                $res[] = array("id" => $article->getId(), "name" => $article->getNom(), "desc" => $article->getDescription(),
                    "cat" => $article->getCategorie(), "date" => $article->getDatePub(), "img" => "/" . $img,
                    "prix" => $article->getPrix() . "DT", "oldprix" => $op);
                $responses = $res;
                $i++;
            } else {
                $res[] = array("id" => $article->getId(), "name" => $article->getNom(), "desc" => $article->getDescription(),
                    "cat" => $article->getCategorie(), "date" => $article->getDatePub(), "img" => "/images/item-02.jpg",
                    "prix" => $article->getPrix() . "DT", "oldprix" => $op);
                $responses = $res;
                $i++;
            }
        }


        $fresponse = array("nbrc" => $i, "pages" => $pages);
        if ($i > 0)
            $fresponse += $responses;

        return new Response(json_encode($fresponse));

    }


    public function testAction()
    {
        return $this->render('@App/articles/test.html.twig');
    }


    public function articleDetailsAction(Request $request)
    {
        $id = $request->get("id");

        $em = $this->container->get('doctrine')->getManager();

        $article = $em->getRepository('AppBundle:Article')->find($id);

        $res[] = array("id" => $article->getId(), "name" => $article->getNom(), "desc" => $article->getDescription(),
            "cat" => $article->getCategorie(), "date" => $article->getDatePub(), "imgs" => $article->getImages(),
            "prix" => $article->getPrix() . "DT", "oldprix" => $article->getOldprix(), "options" => $article->getOption());
        $responses = $res;

        return new Response(json_encode($responses));

        //  return $this->render('@App/articles/detailsarticle.html.twig',array('article'=>$article));
    }


    public function addCommentAction(Request $request)
    {

        $comment = $request->get('comment');
        $id = $request->get('id');
        $rate = $request->get('rate');

        //    $user_id = $request->get('user_id');

        $user = $this->get('security.token_storage')->getToken()->getUser();

        $avis = new Avis();
        $em = $this->container->get('doctrine')->getManager();

        $post = $em->getRepository('AppBundle:Article')->find($id);

        //    $user = $em->getRepository('AppBundle:User')->find($user_id);

        $avis->setUser($user);
        $avis->setAvis($comment);
        $avis->setArticle($post);
        $avis->setNote($rate);
        $avis->setDatePub(new \DateTime());

        $em->persist($avis);
        $em->flush();

        $img = "";

        if ($user->getPhotoProf() != null && $user->getPhotoProf() != "") {
            $img = $user->getPhotoProf();
        }


        $response = array("comment_id" => $avis->getId(), "comment" => $comment, "article" => $id, "date" => $avis->getDatePub(), "mine" => true, "img_user" => $img,
            "user_id" => $user->getId(), "user_name" => $user->getNom() . ' ' . $user->getPrenom());

        return new Response(json_encode($response));
    }


    public function getCommentsAction(Request $request)
    {
        $art_id = $request->get("id");

        $user = $this->get('security.token_storage')->getToken()->getUser();

        $em = $this->container->get('doctrine')->getManager();

        $comments = $em->getRepository('AppBundle:Avis')->getAllComments($art_id);

        $comment = new Avis();
        //  $comment->getUser()->getPhotoProf();

        $i = 0;
        foreach ($comments as $comment) {


            $datetime1 = new \DateTime();
            $datetime2 = $comment->getDatePub();

            $interval = $datetime1->diff($datetime2);

            $time = "";
            //    echo $interval->format('%h')." Hours ".$interval->format('%i')." Minutes";

            if ($interval->format('%d') >= 1)

                $time = $interval->format('%d') . "j";
            else if ($interval->format('%h') >= 1)

                $time = $interval->format('%h') . "h";
            else if ($interval->format('%i') > 1)

                $time = $interval->format('%i') . "m";
            else
                $time = "1m";


            // $comment = new Avis();

            $mine = false;
            $img = "";

            if ($this->container->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY'))
                if ($user->getId() == $comment->getUser()->getId())
                    $mine = true;

            if ($comment->getUser()->getPhotoProf() != null && $comment->getUser()->getPhotoProf() != "") {
                $img = $comment->getUser()->getPhotoProf();
            }


            $res[] = array("id" => $comment->getId(), "comment" => $comment->getAvis(), "mine" => $mine, "date" => $time,
                "user_id" => $comment->getUser()->getId(), "user_name" => $comment->getUser()->getNom() . ' ' . $comment->getUser()->getPrenom(),
                "img_user" => $img, "rate" => $comment->getNote());

            $responses = $res;
            $i++;
        }


        $fresponse = array("nbrc" => $i);
        if ($i > 0)
            $fresponse += $responses;

        return new Response(json_encode($fresponse));


    }


    public function delCommentAction(Request $request)
    {

        $id = $request->get('id');

        $em = $this->container->get('doctrine')->getManager();

        $em->getRepository('AppBundle:Avis')->deleteComment($id);

        return new Response(json_encode("done"));
    }


}
