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
    
}