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

class SchemaController extends Controller
{
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
     * @Route("/databases")
     */
	public function showDatabases(Connection $conn){
        $databases = print_r($conn->fetchAll('show databases'), true);
        //$employees = $users->fetchColumn($column);
        return new Response(
            '<html><body>'
            . '<p><strong>databases:</strong> ' . $databases . '</p>'
            . '</body></html>'
        );
	}

    /**
     * @Route("/tables")
     */
	public function showTables(Connection $conn){
        $tables = print_r($conn->fetchAll('show tables'), true);
        //$employees = $users->fetchColumn($column);
        return new Response(
            '<html><body>'
            . '<p><strong>tables:</strong> ' . $tables . '</p>' 
            . '</body></html>'
        );
	}

    /**
     * @Route("/columns")
     */
	public function showColumns(Connection $conn){
		$query = "SELECT * 
			FROM
			  INFORMATION_SCHEMA.COLUMNS 
			WHERE
			  TABLE_SCHEMA = 'employees'
			AND
			  TABLE_NAME = 'employees';";

        $columns = print_r($conn->fetchAll($query), true);
        //$employees = $users->fetchColumn($column);

        return new Response(
            '<html><body>'
            . '<p><strong>columns:</strong> ' . $columns . '</p>' 
            . '</body></html>'
        );
	}

    /**
     * @Route("/databases_")
     */
	public function showDatabases_(Connection $conn){

        $databases = print_r($conn->fetchAll('show databases'), true);
        //$employees = $users->fetchColumn($column);


        $tables = print_r($conn->fetchAll('show tables'), true);
        //$employees = $users->fetchColumn($column);

		$query = "SELECT * 
			FROM
			  INFORMATION_SCHEMA.COLUMNS 
			WHERE
			  TABLE_SCHEMA = 'employees'
			AND
			  TABLE_NAME = 'employees';";


        $columns = print_r($conn->fetchAll($query), true);
        //$employees = $users->fetchColumn($column);

        return new Response(
            '<html><body>'
            . '<p><strong>databases:</strong> ' . $databases . '</p>' 
            . '<p><strong>tables:</strong> ' . $tables . '</p>' 
            . '<p><strong>columns:</strong> ' . $columns . '</p>' 
            . '</body></html>'
        );
	}
	
}