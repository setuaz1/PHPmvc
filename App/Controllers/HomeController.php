<?php

declare(strict_types=1);

namespace App\Controllers;

use App\App;

//use App\Invoice;
use App\Models\Invoice;
use App\Models\SignUp;
use App\Models\User;
use App\View;
use PDO;

//use Couchbase\View;

class HomeController
{
    public function index(): View
    {

        $email = 'giogw@doe.com';
        $name = 'Jnadasn Doe';
        $amount = 25;

        $userModel = new User();
        $invoiceModel = new Invoice();

        $invoiceId = (new SignUp($userModel, $invoiceModel))->register(
            [
                'email' => $email,
                'name' => $name,
            ],
            [
                'amount' => $amount,
            ]

        );



        return View::make('index', ['invoice' => $invoiceModel->find($invoiceId)]);
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