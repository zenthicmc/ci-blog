<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class AuthFilter implements FilterInterface
{
   public function before(RequestInterface $request, $arguments = null)
   {
      if(!session()->has('id')) {
         return redirect()->to('/auth/login')->with('error', 'You must login first!');
      }      
   }

   public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
   {
      // Do something here
   }
}