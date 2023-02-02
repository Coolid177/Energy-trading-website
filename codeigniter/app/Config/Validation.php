<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;
use CodeIgniter\Validation\CreditCardRules;
use CodeIgniter\Validation\FileRules;
use CodeIgniter\Validation\FormatRules;
use CodeIgniter\Validation\Rules;
use Config\CustomRules;

class Validation extends BaseConfig
{
    // --------------------------------------------------------------------
    // Setup
    // --------------------------------------------------------------------

    /**
     * Stores the classes that contain the
     * rules that are available.
     * 
     * @var string[]
     */
    public $ruleSets = [
        Rules::class,
        FormatRules::class,
        FileRules::class,
        CreditCardRules::class,
        CustomRules::class,
    ];

    /**
     * Specifies the views that are used to display the
     * errors.
     *
     * @var array<string, string>
     */
    public $templates = [
        'list'   => 'CodeIgniter\Validation\Views\list',
        'single' => 'CodeIgniter\Validation\Views\single',
        'create_account' => 'login/create_account',
    ];

    // --------------------------------------------------------------------
    // Rules
    // --------------------------------------------------------------------
    public $signup = [
        'Email'=>[
            'rules'=>'required|valid_email|is_unique[Users.Email]', 
            'errors' => [
                'required' => 'enter your email please',
                'valid_email' => 'please enter a valid email',
                'is_unique' => 'this email is already taken',       
            ]
        ],
        'Fname' => [
            'rules' => 'required|min_length[3]|max_length[32]', 
            'errors' => [
                'required' => 'please enter your first name',
                'min_length' => 'your first name must have a length of at least 3',
                'max_length' => 'your first name must be less than 32 characters'
                ]
        ],
        'Lname' => [
            'rules' => 'required|min_length[3]|max_length[32]',
            'errors' => [
                'required' => 'please enter your last name',
                'min_length' => 'your last name must have a length of at least 3',
                'max_length' => 'your last name must be less than 32 characters'
                ]
        ],
        'Password' => [
            'rules' => 'required|max_length[32]|min_length[8]',
            'errors' => [
                'required' => 'password is required',
                'min_length' => 'password should be a minimum of 8 characters',
                'max_length' => 'password must be less than 32 characters'
            ]
            ],
        'Cpassword' => [
            'rules' => 'required|matches[Password]',
            'errors' => [
                'required' => 'please confirm your password',
                'matches' => 'passwords do not match'
            ]
        ]
    ];

    public $product =[
        'title'=>[
            'rules'=>'required|is_unique[Products.Title]|max_length[128]', 
            'errors' => [
                'max_length' => 'please choose a shorter title',
                'required' => 'please enter a name for your product',
                'is_unique' => 'this product name is already taken',       
            ]
        ],
        'price' => [
            'rules' => 'required|integer',
            'errors' => [
                'required' => 'please enter a price for your product',
                'integer' => 'please use a valid price',
            ]
        ],
        'type' => [
            'rules' => 'required|in_list[Aardgas, Biogas, Butaan, Propaan, Aardolie, Synthetische olie, Pellets, Briketten, Brandhout, Deelbare energie]',
            'errors' => [
                'required' => 'please select an energy type',
                'in_list' => 'please select a valid energy type'
            ]
        ],
        'description' => [
            'rules' => 'required|max_length[4000]|min_length[50]',
            'errors' => [
                'required' => 'please write a description',
                'max_length' => "you can't use more than 4000 characters",
                'min_length' => "please describe your product a bit more",
                ]
            ],
        'origin' => [
            'rules' => 'required|max_length[128]|min_length[3]',
            'errors' => [
                'required' => 'please select the origin',
                'max_length' => 'this origin is too long. max is 128 characters',
                'min_length' => 'this origin is too shor. minimum length is three characters',
                ]
            ],
        'quantity' => [
            'rules' => 'required|integer',
            'errors' => [
                'required' => 'please set the quantity that you have in stock',
                'integer' => 'please set a valid quantity'
                ]
            ],
        'images' => [
            'rules' => 'ext_in[images,png,jpg,jpeg,mkv,mp4]|uploaded[images]|max_size[images,9999]|mime_in[images,image/png,image/jpeg,image/jpg,video/mp4,video/mkv]',
            'errors' => [
                'uploaded' => 'please upload at least one file',
                'max_size' => 'file size needs to be under 10mb',
                'mime_in' => 'only png, jpg, jpeg, mkv and mp4 file formats are allowed',
                'ext_in' => 'only png, jpg, jpeg, mkv and mp4 file formats are allowed',
            ]
        ]
    ];

    public $editProduct = [
        'title'=>[
            'rules'=>'required|max_length[128]', 
            'errors' => [
                'max_length' => 'please choose a shorter title',
                'required' => 'please enter a name for your product',
            ]
        ],
        'price' => [
            'rules' => 'required|integer',
            'errors' => [
                'required' => 'please enter a price for your product',
                'integer' => 'please use a valid price',
            ]
        ],
        'type' => [
            'rules' => 'required|in_list[Aardgas, Biogas, Butaan, Propaan, Aardolie, Synthetische olie, Pellets, Briketten, Brandhout, Deelbare energie]',
            'errors' => [
                'required' => 'please select an energy type',
                'in_list' => 'please select a valid energy type'
            ]
        ],
        'description' => [
            'rules' => 'required|max_length[4000]|min_length[50]',
            'errors' => [
                'required' => 'please write a description',
                'max_length' => "you can't use more than 4000 characters",
                'min_length' => "please describe your product a bit more",
            ]
            ],
        'origin' => [
            'rules' => 'required|max_length[128]|min_length[3]',
            'errors' => [
                'required' => 'please select the origin',
                'max_length' => 'this origin is too long. max is 128 characters',
                'min_length' => 'this origin is too shor. minimum length is three characters',
            ]
            ],
        'quantity' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'please set the quantity that you have in stock',
            ]
            ],
        'images' => [
            'rules' => 'ext_in[images,png,jpg,jpeg,mkv,mp4]|max_size[images,9999]|mime_in[images,image/png,image/jpeg,image/jpg,video/mp4,video/mkv]',
            'errors' => [
                'max_size' => 'file size needs to be under 10mb',
                'mime_in' => 'only png, jpg, jpeg, mkv and mp4 file formats are allowed',
                'ext_in' => 'only png, jpg, jpeg, mkv and mp4 file formats are allowed',
            ]
        ]
    ];

    public $orderDelivery = [
        'street' => [
            'rules' => 'required|max_length[128]|min_length[3]',
            'errros' => [
                'required' => 'Please provide the street',
                'max_length' => 'Your street can not be longer than 128 characters',
                'min_length' => 'Your street name needs to be longer than 3 characters',
            ]
        ],
        'number' => [
            'rules' => 'required|integer',
            'errors' => [
                'required' => 'Please provide your address number',
                'integer' => 'Please provide a valid address',
            ]
        ],
        'city' => [
            'rules' => 'required|max_length[128]|min_length[3]',
            'errors' => [
                'required' => 'Please provide a city',
                'max_length' => 'City name needs to be less than 128 characters',
                'min_length' => 'City name needs to be at least 3 characters long',
            ]
        ],
        'postal_code' => [
            'rules' => 'required|integer',
            'errors' => [
                'required' => 'Please provide your postal code',
                'integer' => 'Your postal code needs to be an integer',
            ]
        ], 
        'country' => [
            'rules' => 'required|max_length[64]|min_length[3]',
            'errors' => [
                'required' => 'Please provide the country',
                'max_length' => 'Country needs to be less than 64 characters',
                'min_length' => 'Country name needs to be more than 3 characters'
            ]
        ], 
        'deliver_option' => [
            'rules' => 'required|in_list[Delivery]',
            'errors' => [
                'required' => 'please select a valid delivery option',
                'in_list' => 'please pick a valid option'
            ]
        ],
        'date_of_delivery' => [
            'rules' => 'required|betweenDeliveryDate',
            'errors' => [
                'required' => 'please select a date of delivery'
            ]
        ],
        'delivery_time' => [
            'rules' => 'required|in_list[Morning,Afternoon]',
            'errors' => [
                'required' => 'please select a time of delivery',
                'in_list' => 'please pick a valid option'
            ]
        ],
        'expiration_date' => [
            'rules' => 'required|valid_date[m/y]',
            'errors' => [
                'required' => 'please fill in an expiration date',
                'valid_date' => 'please fill in a valid date (mm/yy)'        
            ]
        ],
        'card_number' => [
            'rules' => 'required|valid_cc_number[mastercard]',
            'errors' => [
                'required' => 'please fill in your bankcard',
                'Mastercard' => 'not a valid card number'
            ]
        ]
    ];

    public $orderCollect = [
        'date_of_delivery' => [
            'rules' => 'required|betweenDeliveryDate',
            'errors' => [
                'required' => 'please select a date of delivery'
            ]
        ],
        'delivery_time' => [
            'rules' => 'required|in_list[Morning,Afternoon]',
            'errors' => [
                'required' => 'please select a time of delivery',
                'in_list' => 'please pick a valid option'
            ]
        ],
        'deliver_option' => [
            'rules' => 'required|in_list[Collect]',
            'errors' => [
                'required' => 'please select a valid delivery option',
                'in_list' => 'please pick a valid option'
            ]
        ],
        'expiration_date' => [
            'rules' => 'required|valid_date[m/y]',
            'errors' => [
                'required' => 'please fill in an expiration date',
                'valid_date' => 'please fill in a valid date (mm/yy)'        
            ]
        ],
        'card_number' => [
            'rules' => 'required|valid_cc_number[mastercard]',
            'errors' => [
                'required' => 'please fill in your bankcard',
                'valid_cc_number' => 'not a valid card number'
            ]
        ]
    ];

    public $validateReview = [
        'Title' => [
            'rules' => 'required|max_length[128]|min_length[10]|alpha_space',
            'errors' => [
                'required' => 'please provide a title',
                'max_length' => 'the maximum length is 128 characters',
                'min_length' => 'the minimum length is 10 characters',
                'alpha_space' => 'title can only contain alphanumeric characters and spaces'
            ]
        ],
        'Description' => [
            'rules' => 'required|max_length[300]|min_length[50]',
            'errors' => [
                'required' => 'please provide a description',
                'max_length' => 'the maximum length is 300 characters',
                'min_length' => 'the minimum length is 50 characters',
            ]
        ],
        'Stars' => [
            'rules' => 'required|greater_than_equal_to[0]|less_than_equal_to[5]|integer',
            'errors' => [
                'required' => 'please select a rating out of 5',
                'greater_than_equal_to' => 'please select a rating between 0 and 5',
                'less_than_equal_to' => 'please select a rating between 0 and 5',
                'integer' => 'please select a valid rating out of 5',
            ]
        ]
    ];

    public $validateProfile = [
        'new_phone_number' => [
            'rules' => 'required|max_length[15]|min_length[10]',
            'errors' => [
                'required' => 'Please enter a phone number',
                'max_length' => 'maximum length for a phone number is 15',
                'min_length' => 'phone number needs to be at least 10 numbers'
            ]
        ],
        'new_company' => [
            'rules' => 'required|alpha_space|max_length[128]|min_length[3]',
            'errors' => [
                'required' => 'Please provide a company name',
                'alpha_space' => 'please use only spaces and alphanumeric characters',
                'max_length' => 'Company name should not be longer than 128 characters',
                'min_length' => 'Company name should be at least 3 characters long'
            ]
        ],
        'new_description' => [
            'rules' => 'required|max_length[1000]|min_length[50]',
            'errors' => [
                'required' => 'Please provide a profile description',
                'max_length' => 'Description can not be longer than 1000 characters',
                'min_length' => 'Description should be at least 50 characters long',
            ]
        ],
        'images' => [
            'rules' => 'ext_in[images,png,jpg,jpeg,mkv,mp4]|max_size[images,9000]|mime_in[images,image/png,image/jpeg,image/jpg,video/mp4,video/mkv]',
            'errors' => [
                'max_size' => 'file size needs to be under 9mb',
                'mime_in' => 'only png, jpg, jpeg, mkv and mp4 file formats are allowed',
                'ext_in' => 'only png, jpg, jpeg, mkv and mp4 file formats are allowed',
            ]
        ]
    ];
}
