<?php

/**
 * @author Rune Rombouts 2158153
 */

namespace App\Controllers;

use App\Models\UsersModel;

class PublicPagesController extends BaseController
{
    public function sitemap(){
        return view('extras/sitemap');
    }

    /**
     * Validates a user login attempt
     */
    public function validateLogin()
    {
        $model = model(UsersModel::class);
        $isValidUser = $model->isValidUser($this->request->getPost("Email"), $this->request->getPost("Password"));
        if ($isValidUser){
            return redirect()->to('home'); 
        } else {
            return redirect()->to('login')->with('login failed', 'wrong password or email');
        }
    }

    /**
     * Creates a new profile for the user
     */
    public function createProfile()
    {
        $validation = \Config\Services::validation();
        if (!$validation->run($this->request->getPost(), 'signup')){
            $errors = $validation->getErrors(); 
            return view('login/create_account', $errors);
        } else {
            $model = model(UsersModel::class);
            $venderBool = false;
            if (!(empty($this->request->getPost('isVendor')))){
                $venderBool = true;
            }
            $data = [
                'Fname' => $this->request->getPost('Fname'),
                'Lname' => $this->request->getPost('Lname'),
                'Email' => $this->request->getPost('Email'),
                'Password' => password_hash($this->request->getPost('Password'), PASSWORD_DEFAULT),
                'isVendor' => $venderBool,
            ];
            $primaryKey = $model->insert($data);
            if ($venderBool){
                model(VendorModel::class)->insert(['VendorId'=>$primaryKey]);
            }
            return redirect()->to('login')->with('account_created', 'account created succesfully');
        }
    }

    /**
     * logs a user out by destroying the session
     */
    public function logOut(){
        session()->destroy();
        return redirect()->to('/login')->with('logged_out', 'You have been succesfully logged out');
    }

    /**
     * @return the homepage
     */
    public function viewHome()
    {
        return view('login/home');
    }

    public function accessibility(){
        return view('extras/accessibilityStatement');
    }

    /**
     * displays the requested $page
     * @pre $page is an existing page
     */
    public function view($page)
    {
        return view('login/'.$page);
    }
} 