<?php

namespace Extia\ServiceImageBundle\Controller;
//use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\FOSRestController;
use Extia\ServiceImageBundle\Entity\Image;


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
    public function postImageAction(Request $request)
    {
        $image = new Image();
        $file = $request->files->get('file');
        $info = pathinfo($file->getClientOriginalName());
        $originalFileName =  basename($file->getClientOriginalName(),'.'.$info['extension']);
        $fileCode = md5(uniqid());
        $fileCodeName =  $fileCode.'.'.$file->guessExtension();

        $image->setImageFullName($fileCodeName );
        $image->setImageName($originalFileName );
        $image->setImageExtension($file->guessExtension() );
        $image->setImageSize($file->getClientSize()  );

        $image->setImageCode($fileCode );
        $image->setImageType($file->getClientMimeType() );

        $file->move(
            $this->getParameter('api_service_image_directory'),
            $fileCodeName
        );

        $em = $this->getDoctrine()->getManager();
        $em->persist($image);
        $em->flush();
        $response = new JsonResponse();
        $response->setData(array('message' => 'success'));
        return $response;


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
