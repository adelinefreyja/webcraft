<?php

namespace App\Entity;

class Ecommerce {

    private $pdo;

    public function __construct() {

        $donnees = explode(",", file_get_contents("bdd.txt"));

        $db_host = $donnees[0];
        $db_username = $donnees[1];
        $db_password = $donnees[2];
        $db_name = $donnees[3];

        unlink("bdd.txt");

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
        ADD CONSTRAINT
        `constraint_address` FOREIGN KEY (`id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
			) ENGINE=InnoDB DEFAULT CHARSET=latin1;"
        );

        $connexion->query(
            "CREATE TABLE IF NOT EXISTS customers (
        cutomers_id INT(20) AUTO_INCREMENT PRIMARY KEY,
        id INT(20) NOT NULL,
        user_address_id INT(20) NOT NULL,
        user_landPhone INT(10) NOT NULL,
        user_mobilePhone INT(10) NOT NULL,
        ADD CONSTRAINT
        `constraint_customers` FOREIGN KEY (`id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
        ) ENGINE=InnoDB DEFAULT CHARSET=latin1;"
        );

                $connexion->query(
                    "CREATE TABLE IF NOT EXISTS products_tax (
    tax_id INT(20) AUTO_INCREMENT PRIMARY KEY,
    tax_value FLOAT NOT NULL,
    tax_name  VARCHAR(20) NOT NULL,
  ) ENGINE=InnoDB DEFAULT CHARSET=latin1;"
                );

        $connexion->query(
            "CREATE TABLE IF NOT EXISTS products (
          product_id INT(20) AUTO_INCREMENT PRIMARY KEY,
          product_price INT(20) NOT NULL,
          product_sale  INT(20) NOT NULL,
          tax_id INT(20) NOT NULL,
          product_name VARCHAR(255) NOT NULL,
          product_description TEXT NOT NULL,
          ADD CONSTRAINT
          `constraint_products` FOREIGN KEY (`tax_id`) REFERENCES `products_tax` (`tax_id`) ON DELETE RESTRICT ON UPDATE CASCADE,
        ) ENGINE=InnoDB DEFAULT CHARSET=latin1;"
        );

        $connexion->query(
            "CREATE TABLE IF NOT EXISTS products_comments (
      productComment_id INT(20) AUTO_INCREMENT PRIMARY KEY,
      product_id INT(20) NOT NULL,
      id  INT(20) NOT NULL,
      note_value INT(1) NOT NULL,
      comment_text TEXT NOT NULL,
      ADD CONSTRAINT
      `constraint_comment1` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE,
      `constraint_comment2` FOREIGN KEY (`id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
    ) ENGINE=InnoDB DEFAULT CHARSET=latin1;"
        );

        $connexion->query(
            "CREATE TABLE IF NOT EXISTS products_colors (
    productColor_id INT(20) AUTO_INCREMENT PRIMARY KEY,
    product_id INT(20) NOT NULL,
    color_value VARCHAR(15) NOT NULL,
    color_stock INT(20) NOT NULL,
    ADD CONSTRAINT
    `constraint_products_color` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ) ENGINE=InnoDB DEFAULT CHARSET=latin1;"
        );

        $connexion->query(
            "CREATE TABLE IF NOT EXISTS products_images (
      productImg_id INT(20) AUTO_INCREMENT PRIMARY KEY,
      product_id INT(20) NOT NULL,
      image VARCHAR(150) NOT NULL,
      ADD CONSTRAINT
      `constraint_products_image` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE,
    ) ENGINE=InnoDB DEFAULT CHARSET=latin1;"
        );

        $connexion->query(
            "CREATE TABLE IF NOT EXISTS products_sizes (
            productSize_id INT(20) AUTO_INCREMENT PRIMARY KEY,
            product_id INT(20) NOT NULL,
            size_value VARCHAR(15) NOT NULL,
            size_stock INT(20) NOT NULL,
            ADD CONSTRAINT
            `constraint_products_size` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE,
          ) ENGINE=InnoDB DEFAULT CHARSET=latin1;"
        );
        $connexion->query(
            "CREATE TABLE IF NOT EXISTS products_category (
    productCat_id INT(20) AUTO_INCREMENT PRIMARY KEY,
    product_id INT(20) NOT NULL,
    category_value VARCHAR(15) NOT NULL,
    ADD CONSTRAINT
    `constraint_products_category` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ) ENGINE=InnoDB DEFAULT CHARSET=latin1;"
        );

                $connexion->query(
                    "CREATE TABLE IF NOT EXISTS orders (
          order_id INT(20) AUTO_INCREMENT PRIMARY KEY,
            id INT(20) NOT NULL,
            order_date DATETIME NOT NULL,
            order_status VARCHAR(30) NOT NULL,
            ADD CONSTRAINT
            `constraint_order` FOREIGN KEY (`id`) REFERENCES `user` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
          ) ENGINE=InnoDB DEFAULT CHARSET=latin1;"
                );

        $connexion->query(
            "CREATE TABLE IF NOT EXISTS payment (
        payment_id INT(20) AUTO_INCREMENT PRIMARY KEY,
        order_id INT(20) NOT NULL,
        payment_method VARCHAR(30) NOT NULL,
        ADD CONSTRAINT
        `constraint_payment` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`) ON DELETE SET NULL ON UPDATE CASCADE,
        ) ENGINE=InnoDB DEFAULT CHARSET=latin1;"
        );

        $connexion->query(
            "CREATE TABLE IF NOT EXISTS shipment (
          shipment_id BIGINT(20) AUTO_INCREMENT PRIMARY KEY,
          order_id BIGINT(20) NOT NULL,
          shipment_method VARCHAR(30) NOT NULL,
          ADD CONSTRAINT
          `constraint_shipment` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`) ON DELETE SET NULL ON UPDATE CASCADE,
          ) ENGINE=InnoDB DEFAULT CHARSET=latin1;"
        );

                $connexion->query(
                    "CREATE TABLE IF NOT EXISTS sales (
      sales_id INT(20) AUTO_INCREMENT PRIMARY KEY,
      id INT(20) NOT NULL,
      product_id INT(20) NOT NULL,
      order_id BIGINT(20) NOT NULL,
      payment_id INT(20) NOT NULL,
      shipment_id BIGINT(20) NOT NULL,
      ADD CONSTRAINT
      `constraint_sales` FOREIGN KEY (`id`) REFERENCES `user` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
      `constraint_sales1` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE SET NULL ON UPDATE CASCADE,
      `constraint_sales2` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`) ON DELETE SET NULL ON UPDATE CASCADE,
      `constraint_sales3` FOREIGN KEY (`payment_id`) REFERENCES `payment` (`payment_id`) ON DELETE SET NULL ON UPDATE CASCADE,
      `constraint_sales4` FOREIGN KEY (`shipment_id`) REFERENCES `shipment` (`shipment_id`) ON DELETE SET NULL ON UPDATE CASCADE,
    ) ENGINE=InnoDB DEFAULT CHARSET=latin1;"
                );
    }
}
