<?php

// src/Controller/LuckyController.php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use App\Service\MessageGenerator;
use Faker;

use Doctrine\DBAL\Driver\Connection;

//use Fakerino\Fakerino

class PopulateController extends Controller
{
    /**
     * @Route("/populate/users")
     */
	public function users(Connection $conn){
		// use the factory to create a Faker\Generator instance
		$faker = Faker\Factory::create();
		// generate data by accessing properties
		$res =  "";
		$separator = "";
		for ($i = 0; $i < 20; $i++){
			$res .=  $separator;
			$res .=  "<strong>" . $faker->name . "</strong><br>";
			$res .=  $faker->catchPhrase . "<br>";
			$res .=  $faker->bs . "<br>";
			$res .=  $faker->company . "<br>";
			$res .=  $faker->companySuffix . "<br>";
			$res .=  $faker->jobTitle . "<br>";
			$res .=  $faker->address . "<br>";
			$res .=  $faker->text . "<br>";
			$separator = "======================================================<br>";
		}

        $employees = $conn->fetchColumn('SELECT COUNT(*) FROM employees');
        //$employees = $users->fetchColumn($column);

        return new Response(
            '<html><body>employees: '.$employees.'<br>Populate users:<br '. $res .'</body></html>'
        );
	}


    /**
     * @Route("/employees/count")
     */
	public function employeesCount(Connection $conn){

        $employees = $conn->fetchColumn('SELECT COUNT(*) FROM employees');
        //$employees = $users->fetchColumn($column);

        return new Response(
            '<html><body>employees: '.$employees.'</body></html>'
        );
	}












    /**
     * @Route("/r301")
     * /
	public function redirect301(){
	    // do a permanent - 301 redirect
	    return $this->redirectToRoute('homepage', array(), 301);
    }

    /**
     * @Route("/reouteredirect")
     * /
	public function routeredirect(){
	    // redirect to a route with parameters
	    return $this->redirectToRoute('app_lucky_number', array('max' => 10));
    }

    /**
     * @Route("/redirectexternally")
     * /
	public function torouteexternally(){
	    // redirect externally
	    return $this->redirect('http://symfony.com/doc');
	}

    /**
     * @Route("/rendertemplate")
     * /
	public function rendertemplate(){
		// renders templates/lucky/number.html.twig
		return $this->render('lucky/number.html.twig', array('name' => $name));
	}
    
    /**
     * @Route("/messagegenerator")
     * /
	public function new(MessageGenerator $messageGenerator)
	{
	    // thanks to the type-hint, the container will instantiate a
	    // new MessageGenerator and pass it to you!
	    // ...
	    $message = $messageGenerator->getHappyMessage();
	    $this->addFlash('messages', $message);
	    
	    return $this->render('base.html.twig', array('name' => "flash messages"));
	}
	/**/
}