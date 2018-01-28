<?php

// src/Controller/LuckyController.php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use App\Service\MessageGenerator;


class DemoController extends Controller
{
    /**
     * @Route("/redirect")
     */
	public function redirectroute(){
    	// redirect to the "homepage" route
	    return $this->redirectToRoute('homepage');
	    // redirectToRoute is a shortcut for:
	    // return new RedirectResponse($this->generateUrl('homepage'));
	}

    /**
     * @Route("/r301")
     */
	public function redirect301(){
	    // do a permanent - 301 redirect
	    return $this->redirectToRoute('homepage', array(), 301);
    }

    /**
     * @Route("/reouteredirect")
     */
	public function routeredirect(){
	    // redirect to a route with parameters
	    return $this->redirectToRoute('app_lucky_number', array('max' => 10));
    }

    /**
     * @Route("/redirectexternally")
     */
	public function torouteexternally(){
	    // redirect externally
	    return $this->redirect('http://symfony.com/doc');
	}

    /**
     * @Route("/rendertemplate")
     */
	public function rendertemplate(){
		// renders templates/lucky/number.html.twig
		return $this->render('lucky/number.html.twig', array('name' => $name));
	}
    
    /**
     * @Route("/messagegenerator")
     */
	public function new(MessageGenerator $messageGenerator)
	{
	    // thanks to the type-hint, the container will instantiate a
	    // new MessageGenerator and pass it to you!
	    // ...
	    $message = $messageGenerator->getHappyMessage();
	    $this->addFlash('messages', $message);
	    
	    return $this->render('base.html.twig', array('name' => "flash messages"));
	}
}