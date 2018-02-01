<?php

namespace App\Entity;

class Ecommerce {

    private $pdo;

    public function __construct() {

        $db_host = $_SESSION["bdd"]["db_host"];
        $db_username = $_SESSION["bdd"]["db_username"];
        $db_password = $_SESSION["bdd"]["db_password"];
        $db_name = $_SESSION["bdd"]["db_name"];

        session_destroy();

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

    public function createEcommerce() {

        $connexion = $this->pdo;

        $connexion->query(
            "CREATE TABLE IF NOT EXISTS user_address (
				user_address_id INT(20) AUTO_INCREMENT PRIMARY KEY,
				id INT(20) NOT NULL,
				user_addressName VARCHAR(255) NOT NULL,
				user_address VARCHAR(255) NOT NULL,
				user_zipCode INT(6) NOT NULL,
				user_city VARCHAR(255) NOT NULL,
				user_comment VARCHAR(255) NOT NULL,
				FOREIGN KEY (`id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
			);"
        );

        $connexion->query(
            "CREATE TABLE IF NOT EXISTS customers (
            cutomers_id INT(20) AUTO_INCREMENT PRIMARY KEY,
            id INT(20) NOT NULL,
            user_address_id INT(20) NOT NULL,
            user_landPhone INT(10) NOT NULL,
            user_mobilePhone INT(10) NOT NULL,
            FOREIGN KEY (`id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
            );"
        );

        $connexion->query(
            "CREATE TABLE IF NOT EXISTS products_tax (
            tax_id INT(20) AUTO_INCREMENT PRIMARY KEY,
            tax_value FLOAT NOT NULL,
            tax_name  VARCHAR(20) NOT NULL
            );"
        );

        $connexion->query(
            "CREATE TABLE IF NOT EXISTS products (
            product_id INT(20) AUTO_INCREMENT PRIMARY KEY,
            product_price INT(20) NOT NULL,
            product_sale INT(30),
            tax_id INT(20),
            product_name VARCHAR(255) NOT NULL,
            product_description TEXT NOT NULL,
            FOREIGN KEY (`tax_id`) REFERENCES `products_tax` (`tax_id`) ON DELETE RESTRICT ON UPDATE CASCADE
            );"
        );

        $connexion->query(
            "CREATE TABLE IF NOT EXISTS products_comments (
            productComment_id INT(20) AUTO_INCREMENT PRIMARY KEY,
            product_id INT(20) NOT NULL,
            id  INT(20) NOT NULL,
            note_value INT(1) NOT NULL,
            comment_text TEXT NOT NULL,
            FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE,
            FOREIGN KEY (`id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
            );"
        );

        $connexion->query(
            "CREATE TABLE IF NOT EXISTS products_colors (
            productColor_id INT(20) AUTO_INCREMENT PRIMARY KEY,
            product_id INT(20) NOT NULL,
            color_value VARCHAR(15) NOT NULL,
            color_stock INT(20) NOT NULL,
            FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE
            );"
        );

        $connexion->query(
            "CREATE TABLE IF NOT EXISTS products_images (
            productImg_id INT(20) AUTO_INCREMENT PRIMARY KEY,
            product_id INT(20),
            image VARCHAR(150),
            FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE
            );"
        );

        $connexion->query(
            "CREATE TABLE IF NOT EXISTS products_sizes (
            productSize_id INT(20) AUTO_INCREMENT PRIMARY KEY,
            product_id INT(20) NOT NULL,
            size_value VARCHAR(15) NOT NULL,
            size_stock INT(20) NOT NULL,
            FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE
          );"
        );
        $connexion->query(
            "CREATE TABLE IF NOT EXISTS products_category (
            productCat_id INT(20) AUTO_INCREMENT PRIMARY KEY,
            product_id INT(20),
            category_value VARCHAR(15) NOT NULL
          );"
        );

                $connexion->query(
                    "CREATE TABLE IF NOT EXISTS orders (
          order_id BIGINT(20) AUTO_INCREMENT PRIMARY KEY,
            id INT(20) NOT NULL,
            order_date DATETIME NOT NULL,
            order_status VARCHAR(30) NOT NULL,
            FOREIGN KEY (`id`) REFERENCES `user` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE
          );"
                );

        $connexion->query(
            "CREATE TABLE IF NOT EXISTS payment (
            payment_id INT(20) AUTO_INCREMENT PRIMARY KEY,
            payment_method VARCHAR(30) NOT NULL
            );"
        );

        $connexion->query(
            "CREATE TABLE IF NOT EXISTS categories (
            category_id INT(20) AUTO_INCREMENT PRIMARY KEY,
            category_name VARCHAR(20) NOT NULL
            );"
        );

        $connexion->query(
            "CREATE TABLE IF NOT EXISTS shipment (
          shipment_id BIGINT(20) AUTO_INCREMENT PRIMARY KEY,
          shipment_method VARCHAR(30) NOT NULL,
          shipment_price FLOAT(3) NOT NULL
          );"
        );

                $connexion->query(
                    "CREATE TABLE IF NOT EXISTS sales (
      sales_id INT(20) AUTO_INCREMENT PRIMARY KEY,
      id INT(20) NOT NULL,
      product_id INT(20) NOT NULL,
      order_id BIGINT(20) NOT NULL,
      payment_id INT(20) NOT NULL,
      shipment_id BIGINT(20) NOT NULL,
      FOREIGN KEY (`id`) REFERENCES `user` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE,
      FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE RESTRICT ON UPDATE CASCADE,
      FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`) ON DELETE RESTRICT ON UPDATE CASCADE,
      FOREIGN KEY (`payment_id`) REFERENCES `payment` (`payment_id`) ON DELETE RESTRICT ON UPDATE CASCADE,
      FOREIGN KEY (`shipment_id`) REFERENCES `shipment` (`shipment_id`) ON DELETE RESTRICT ON UPDATE CASCADE
    );"
                );
    }
}
