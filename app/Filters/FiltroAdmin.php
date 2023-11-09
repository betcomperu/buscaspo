<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class FiltroAdmin implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
       

        if (session()->get('isLoggedIn')) {
            return redirect()->to(site_url('/panel'));
        }

        return $request;
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
       
    }

}
