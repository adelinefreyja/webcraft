<?php

namespace App\Controller;

use App\Entity\Database;
use App\Form\DatabaseType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class DatabaseController extends Controller {

    private function connexion($db_host, $db_username, $db_password, $db_name) {

        try {
            $pdo = new \PDO(
                "mysql:host=$db_host;",
                $db_username,
                $db_password,
                array(\PDO::ATTR_ERRMODE => \PDO::ERRMODE_WARNING,
                    \PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8")
            );

            $pdo->exec(
                "CREATE DATABASE IF NOT EXISTS $db_name"
            );
        } catch (\PDOException $e) {
            die("Erreur de connexion à la base de donnée : " . $e->getMessage());
        }
    }

    /**
     * @Route("/setup", name="setup")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function registerAction(Request $request) {

        $database = new Database();

        $form = $this->createForm(DatabaseType::class, $database);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $db_host = $database->getDbHost();
            $db_username = $database->getDbUsername();
            $db_password = $database->getDbPassword();
            $db_name =  $database->getDbName();

            $content1 = "
# This file is a \"template\" of which env vars need to be defined for your application
# Copy this file to .env file for development, create environment variables when deploying to production
# https://symfony.com/doc/current/best_practices/configuration.html#infrastructure-related-configuration

###> symfony/framework-bundle ###
APP_ENV=dev
APP_SECRET=33a27d07aced1ff0823b4d69b1d924f6
#TRUSTED_PROXIES=127.0.0.1,127.0.0.2
#TRUSTED_HOSTS=localhost,example.com
###< symfony/framework-bundle ###

###> doctrine/doctrine-bundle ###
# Format described at http://docs.doctrine-project.org/projects/doctrine-dbal/en/latest/reference/configuration.html#connecting-using-a-url
# For an SQLite database, use: \"sqlite:///%kernel.project_dir%/var/data.db\"
# Configure your db driver and server_version in config/packages/doctrine.yaml";

            $text = "DATABASE_URL=mysql://'$db_username':'$db_password'@$db_host/'$db_name'";

            $content2 = "###< doctrine/doctrine-bundle ###";

            $fullContent = $content1 . "\r\n" . $text . "\r\n" . $content2;
            file_put_contents("../.env", $fullContent);

            $this->connexion($db_host, $db_username, $db_password, $db_name);

            return $this->redirectToRoute('setup2');
        }

        return $this->render('setup/setup1.html.twig',
            ['form' => $form->createView()]
        );
    }
}