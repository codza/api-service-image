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
        $em = $this->getDoctrine()->getManager();
        $imageRepository= $em->getRepository("ServiceImageBundle:Image");
        $images = $imageRepository->findAll();

        $serializer = $this->get('serializer');
        $imagesSerialised = $serializer->serialize($images, 'json');

        $response = new JsonResponse();
        $response->setData(array('status' => 'success','images' => $imagesSerialised));
        return $response;

    }

    // "get_image" -- [GET] /image/{id}
    // renvois les info d'une image
    public function getImageAction($id)
    {

        $em = $this->getDoctrine()->getManager();
        $imageRepository= $em->getRepository("ServiceImageBundle:Image");
        $image = $imageRepository->find($id);

        $serializer = $this->get('serializer');
        $imageSerialised = $serializer->serialize($image, 'json');

        $response = new JsonResponse();
        $response->setData(array('status' => 'success','images' => $imageSerialised));
        return $response;

    }
    // "raw_image" -- [GET] /image/{id}/raw
    // renvois l'image en elle même (download)
    public function getImageRawAction($id)
    {

        $em = $this->getDoctrine()->getManager();
        $imageRepository= $em->getRepository("ServiceImageBundle:Image");
        $image = $imageRepository->find($id);
        $fileDownload = $this->getParameter('api_service_image_directory')."/".$image->getImageFullName();

/*        $response = new JsonResponse();
        $response->setData(array('status' => 'success','images' => $filetodownload));
        return $response;*/

        $response = new Response();
        $response->setContent(file_get_contents($fileDownload));
        $response->headers->set('Content-Type', 'application/force-download'); // modification du content-type pour forcer le téléchargement (sinon le navigateur internet essaie d'afficher le document)
        $response->headers->set('Content-disposition', 'filename='. $image->getImageFullName());

        return $response;


    }
    // "post_image" -- [POST] /image
    // Création d'une image (upload)
    public function postImageAction(Request $request)
    {
        $image = new Image();
        $file = $request->files->get('file');

   //     die("hello");
        $response = new JsonResponse();
        if($file==NULL){
            $response->setData(array('status' => 'error'));

        }else{

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
            $response->setData(array('status' => 'success'));

        }

        return $response;


    }
    // "put_image" -- [PUT] /images/{id}
    // Mise à jour complete d'une image (upload)
    public function putImageAction($id, Request $request)
    {

        $em = $this->getDoctrine()->getManager();
        $imageRepository= $em->getRepository("ServiceImageBundle:Image");
        $image = $imageRepository->find($id);
        $newFileName = $request->get("newFileName");


        $response = new JsonResponse();
        if ($image==null){
            $response->setData(array('status' => 'error'));
        }else{



            $em->persist($image);
            $em->flush();
            $response->setData(array('status' => 'success'));
        }

    return $response;

    }
    // "patch_user" -- [PATCH] /images/{id}
    // Mise à jour partiel d'une image
    public function patchImageAction($id)
    {

    }



    // "delete_user" -- [DELETE] /image/{id}
    // Suppression d'une image
    public function deleteImageAction($id)
    {

        $em = $this->getDoctrine()->getManager();
        $imageRepository= $em->getRepository("ServiceImageBundle:Image");
        $image = $imageRepository->find($id);

        $response = new JsonResponse();


        if ($image == NULL ){
            $response->setData(array('status' => 'no such image'));
        }else{
            $fileDownload = $this->getParameter('api_service_image_directory')."/".$image->getImageFullName();
            $em->remove($image);
            $em->flush();
            unlink($fileDownload);
            $response->setData(array('status' => 'deleted'));
        }

        return $response;


    }
}
