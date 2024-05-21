<?php

declare(strict_types=1);

namespace App\Controllers;

use App\App;
use App\View;
use PDO;

//use Couchbase\View;

class HomeController
{
    public function index(): View
    {

        $db = App::db();

        $email = 'jnn@doe.com';
        $name = 'Jnn Doe';
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