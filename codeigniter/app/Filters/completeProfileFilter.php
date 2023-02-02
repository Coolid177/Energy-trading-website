<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class completeProfileFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $model = model(VendorModel::class);
        $res = $model->select('Phone_number, Description, Company')->where('VendorId', session()->get('UserId'))->first();
        if ($res['Phone_number'] == null || $res['Description'] == null || $res['Company'] == null){
            return redirect()->to('/profile/profile')->with('fail', 'your account needs to be complete before you can view this page');
        } else { //check for images
            $imageModel = model(UserImageModel::class);
            if(empty ($imageModel->select('Media_name')->where('UserId', session()->get('UserId'))->first())){
                return redirect()->to('/profile/profile')->with('fail', 'your account needs to be complete before you can view this page');
            }
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
    }
}