<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CommonController extends Controller
{
    public function readFile($path)
    {
        $path = readFileUrl("decrypt" , $path);
        return getFileFromPrivateStorage($path);
    }
}
