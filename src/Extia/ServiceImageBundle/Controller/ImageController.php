<?php

namespace Extia\ServiceImageBundle\Controller;
//use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FOS\RestBundle\Controller\FOSRestController;

class ImageController extends FOSRestController
{
/*    public function indexAction($name)
    {
        return $this->render('', array('name' => $name));
    }*/
    // "get_images" -- [GET] /images
    // renvois les infos de toutes les images
    public function getImagesAction()
    {

    }

    // "get_image" -- [GET] /image/{id}
    // renvois les info d'une image
    public function getImageAction($id)
    {

    }
    // "raw_image" -- [GET] /image/{id}/raw
    // renvois l'image en elle même (download)
    public function rawImageAction($id)
    {

    }
    // "post_image" -- [POST] /image
    // Création d'une image (upload)
    public function postImageAction()
    {

    }
    // "put_image" -- [PUT] /image/{id}
    // Mise à jour complete d'une image (upload)
    public function putImageAction($id)
    {

    }
    // "patch_user" -- [PATCH] /image/{id}
    // Mise à jour partiel d'une image
    public function patchImageAction($id)
    {

    }
    // "delete_user" -- [DELETE] /image/{id}
    // Suppression d'une image
    public function deleteImageAction($id)
    {

    }
}
