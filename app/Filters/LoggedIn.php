<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class LoggedIn implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        if (
            session()->has("logged_in") &&
            session()->get("logged_in") === true
        ) {
            return redirect()->to("/");
        }
    }

    public function after(
        RequestInterface $request,
        ResponseInterface $response,
        $arguments = null
    ) {
        // Intentionally blank
    }
}
