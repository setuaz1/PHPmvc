<?php

declare(strict_types=1);

namespace App\Controllers;

use App\View;
//use Couchbase\View;

class HomeController
{
    public function index(): View
    {
        return View::make('index', ['foo' => 'bar']);

//        return (new View('index'))->render();
    }

    public function download()
    {
        header('Content-type: image/png');
        header('Content-Disposition: attachment; filename="myfile.png"');

        readfile(STORAGE_PATH . '/2024-05-09 (19).png');
    }

    public function upload()
    {
//        echo '<pre>';
//        var_dump($_FILES);
//        echo '</pre>';

        $filePath = STORAGE_PATH . '/' . $_FILES['receipt']['name'];
        move_uploaded_file($_FILES['receipt']['tmp_name'], $filePath);

        header('Location: /');
        exit;
    }
}