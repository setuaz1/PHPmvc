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
            $db = new PDO('mysql:host=programwithgio-db;dbname=my_db', 'root', 'root', [
                PDO::ATTR_EMULATE_PREPARES => false,
            ]);
//
//            $email = 'gio2@doe.com';
//            $name = 'Gio Doe';
//            $isActive = 1;
//            $createdAt = date('Y-m-d H:m:i', strtotime('07/11/2021 9:00PM'));
//            $query = 'INSERT INTO users (email, full_name, is_active, created_at, updated_at)
//            VALUES(:email, :name, :active, :date1, :date2)';
//
//            $stmt = $db->prepare($query);
//
//            $stmt = $db->prepare($query);
//
//            $stmt->bindValue(':name', $name);
//            $stmt->bindValue(':email', $email);
//            $stmt->bindParam(':active', $isActive, PDO::PARAM_BOOL);
//            $stmt->bindValue(':date1', $createdAt);
//            $stmt->bindValue(':date2', $createdAt);
//

//            $stmt->execute();

//            $stmt->bindValue('name', $name);

//            $id = (int)$db->lastInsertId();
            $id = 14;
            $user = $db->query('SELECT * FROM users WHERE id = ' . $id)->fetch();

            echo '<pre>';
            var_dump($user);
            echo '</pre>';

        } catch (\PDOException $e) {
            var_dump($e->getCode());
            throw new \PDOException($e->getMessage(), (int)$e->getCode());
        }
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