<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class AuthFilter implements FilterInterface
{

    public function before(RequestInterface $request, $arguments = null)
    {
        if (!session()->has('role')) {
            return redirect()->to('/');
        }


        // $sessionRole = session()->get('role');
        // if ($sessionRole == 'superuser') {
        //     # code...
        // }

        // if ($sessionRole == 'admin') {
        //     # code...
        // }

        // if ($sessionRole == 'user') {
        //     # code...
        // }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // empty
    }
}
