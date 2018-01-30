<?php

namespace App\Controller;

use App\Entity\Database;
use App\Entity\User;
use App\Form\DatabaseType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class DatabaseController extends Controller {

    private $pdo;

    private function createTables() {

        $connexion = $this->pdo;

        $connexion->query(
            "CREATE TABLE IF NOT EXISTS `user` (
                `id` int(11) NOT NULL,
                `username` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
                `password` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
                `user_email` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
                `user_first_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
                `user_last_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
                `user_gender` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
                `user_profile_picture` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
                `user_ip` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
                `is_active` tinyint(1) NOT NULL,
                `roles` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:array)'
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;"
        );

        $connexion->query(
            "ALTER TABLE `user`
                ADD PRIMARY KEY (`id`),
                ADD UNIQUE KEY `UNIQ_8D93D649F85E0677` (`username`),
                ADD UNIQUE KEY `UNIQ_8D93D649550872C` (`user_email`);"
        );

        $connexion->query(
            "ALTER TABLE `user`
                MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
            COMMIT;"
        );

        $connexion->query(
            "CREATE TABLE IF NOT EXISTS `options` (
                `id` int(11) NOT NULL,
                `description` VARCHAR(30) COLLATE utf8_unicode_ci NOT NULL,
                `optionname` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
                `optionvalue` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
                `sitetype` varchar(255) COLLATE utf8_unicode_ci NOT NULL
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;"
        );

        $connexion->query(
            "ALTER TABLE `options`
                ADD PRIMARY KEY (`id`),
                ADD UNIQUE KEY `UNIQ_D035FA87A536B7BB` (`optionname`),
                ADD UNIQUE KEY `UNIQ_D035FA87A85C82CC` (`optionvalue`);"
        );

        $connexion->query(
            "ALTER TABLE `options`
                MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
            COMMIT;"
        );

        $connexion->query(
            "CREATE TABLE IF NOT EXISTS pages (
				page_id INT(20) AUTO_INCREMENT PRIMARY KEY,
				user_id INT(20) NOT NULL,
				page_title VARCHAR(255) NOT NULL,
				page_name VARCHAR(255) NOT NULL,
				page_date DATETIME NOT NULL,
				page_content LONGTEXT NOT NULL,
				page_status VARCHAR(30) NOT NULL,
				comment_status VARCHAR(30) NOT NULL,
				page_type VARCHAR(255),
				page_modified DATETIME
			) ENGINE=InnoDB DEFAULT CHARSET=latin1;"
        );

        $connexion->query(
            "CREATE TABLE IF NOT EXISTS contact (
				message_id INT(20) AUTO_INCREMENT PRIMARY KEY,
				user_id INT(20) NOT NULL,
				message_content LONGTEXT NOT NULL,
				message_date DATETIME NOT NULL,
				message_object VARCHAR(20) NOT NULL
			) ENGINE=InnoDB DEFAULT CHARSET=latin1;"
        );

        $connexion->query(
            "CREATE TABLE IF NOT EXISTS design (
				fw_id INT(20) AUTO_INCREMENT PRIMARY KEY,
				background_color VARCHAR(20) NOT NULL,
				main_color VARCHAR(20) NOT NULL,
				links_color VARCHAR(20) NOT NULL,
				text_primary_color VARCHAR(20) NOT NULL,
				text_secondary_color VARCHAR(20) NOT NULL,
				header_img VARCHAR(20) NOT NULL,
				header_color VARCHAR(20) NOT NULL,
				background_img VARCHAR(20) NOT NULL,
				css_add VARCHAR(20) NOT NULL
			) ENGINE=InnoDB DEFAULT CHARSET=latin1;"
        );

        $connexion->query(
            "CREATE TABLE IF NOT EXISTS medias (
				media_id INT(20) AUTO_INCREMENT PRIMARY KEY,
				media_type VARCHAR(30) NOT NULL,
				media_src VARCHAR(255) NOT NULL,
				media_name VARCHAR(255) NOT NULL,
				media_description TEXT
			) ENGINE=InnoDB DEFAULT CHARSET=latin1;"
        );

        $connexion->query(
            "CREATE TABLE IF NOT EXISTS newsletter (
				email_id INT(20) AUTO_INCREMENT PRIMARY KEY,
				email_value VARCHAR(255) NOT NULL
			) ENGINE=InnoDB DEFAULT CHARSET=latin1;"
        );
    }

    private function connexion($db_host, $db_username, $db_password, $db_name) {

        try {
            $this->pdo = new \PDO(
                "mysql:host=$db_host;",
                $db_username,
                $db_password,
                array(\PDO::ATTR_ERRMODE => \PDO::ERRMODE_WARNING,
                    \PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8")
            );

            $this->pdo->exec(
                "CREATE DATABASE IF NOT EXISTS $db_name"
            );

            $this->pdo->query("USE $db_name");

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

        try {
            $repository = $this->getDoctrine()->getManager()->getRepository(User::class);
            $query = $repository->findAll();

            if (!empty($query)) {
                return $this->redirectToRoute('login');
            }
        } catch (\Exception $e) {

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

                $fullContent = $content1 . "\n" . $text . "\n" . $content2;
                file_put_contents("../.env", $fullContent);


                session_destroy();

                session_start();

                $_SESSION["bdd"] = array();
                $_SESSION["bdd"]["db_host"] = $db_host;
                $_SESSION["bdd"]["db_username"] = $db_username;
                $_SESSION["bdd"]["db_password"] = $db_password;
                $_SESSION["bdd"]["db_name"] = $db_name;

                $this->connexion($db_host, $db_username, $db_password, $db_name);

                $this->createTables();

                return $this->redirectToRoute('setup2');
            }

            return $this->render('setup/setup1.html.twig',
                ['form' => $form->createView()]
            );
        }


    }
}
