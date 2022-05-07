<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MutacionController extends Controller
{
    public function index()
    {
        var_dump($_POST['ovejas']);
    }
}
