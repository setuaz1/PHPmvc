<?php

declare(strict_types=1);

namespace App\Controllers;

use App\View;
use PDO;

//use Couchbase\View;

class HomeController
{
    public function index(): View
    {
        try {
            $db = new PDO('mysql:host=' . $_ENV['DB_HOST'] . ';dbname=' . $_ENV['DB_DATABASE'],
                $_ENV['DB_USER'],
                $_ENV['DB_PASS']
            );
        } catch (\PDOException $e) {
            var_dump($e->getCode());
            throw new \PDOException($e->getMessage(), (int)$e->getCode());
        }

        $email = 'jq@doe.com';
        $name = 'Jq Doe';
        $amount = 25;

        try {
            $db->beginTransaction();

            $newUserStmt = $db->prepare(
                'INSERT INTO users (email, full_name, is_active, created_at)
            VALUES(?, ?, 1, NOW())'
            );

            $newInvoiceStmt = $db->prepare(
                'INSERT INTO invoices (amount, user_id)
            VALUES(?, ?)'
            );


            $newUserStmt->execute([$email, $name]);

            $userId = (int)$db->lastInsertId();

            $newInvoiceStmt->execute([$amount, $userId]);

            $db->commit();
        } catch(\Throwable $e) {
            if($db->inTransaction()) {
                $db->rollback();
            }

            throw $e;
        }
        $fetchStmt = $db->prepare(
            'SELECT invoices.id AS invoice_id, amount, user_id, full_name
            FROM invoices
            INNER JOIN users ON user_id = users.id
            WHERE email = ?'
        );


        $fetchStmt->execute([$email]);

        //$user = $db->query('SELECT * FROM users WHERE id = ' . $id)->fetch();

        echo '<pre>';
        var_dump($fetchStmt->fetch(PDO::FETCH_ASSOC));
        echo '</pre>';

        return View::make('index', ['foo' => 'bar']);
    }


//    public function download()
//    {
//        header('Content-type: image/png');
//        header('Content-Disposition: attachment; filename="myfile.png"');
//
//        readfile(STORAGE_PATH . '/2024-05-09 (19).png');
//    }
//
//    public function upload()
//    {
//
//        $filePath = STORAGE_PATH . '/' . $_FILES['receipt']['name'];
//        move_uploaded_file($_FILES['receipt']['tmp_name'], $filePath);
//
//        header('Location: /');
//        exit;
//    }
}