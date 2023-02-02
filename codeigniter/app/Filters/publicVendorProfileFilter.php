<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class publicVendorProfileFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $model = model(VendorModel::class);
        $res = $model->where('VendorId', current_url(true)->getSegment(3))->first();
        if ($res == null){ //the profile is private
            return redirect()->to('home');
        } //they can view the profile
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
    }
}