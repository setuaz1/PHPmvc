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
        return '<form action="/invoices/create" method="post"><label>Amount</label><input type="text" name="amount"></form>';
    }

    public function store()
    {
        $amount = $_POST['amount'];

        var_dump($amount);
    }
}