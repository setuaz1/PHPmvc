<?php

namespace App\Controllers;

class InvoiceController
{
    public function index():string
    {
//        setcookie(
//            'userName',
//            'Gio',
//            time() - (24 * 60 * 60),
//        );

        return '';
    }

    public function create():string
    {
        return '';
    }

    public function store()
    {
        $amount = $_POST['amount'];

        var_dump($amount);
    }
}