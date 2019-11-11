<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Upload Settings
    |--------------------------------------------------------------------------
    */
    'images_image_sizes' => [
        'lg' => [
            'folder' => 'uploads/categories/lg/',
            'size' => [128, 128]
            ],
        'md' => [
            'folder' => 'uploads/categories/md/',
            'size' => [64, 64]
            ],
        'sm' => [
            'folder' => 'uploads/categories/sm/',
            'size' => [32, 32]
            ],
        'xs' => [
            'folder' => 'uploads/categories/xs/',
            'size' => [24, 24]
            ]
    ],
    'articles_image_sizes' => [
        'lg' => [
            'folder' => 'uploads/articles/lg/',
            'size' => [720, 540]
            ],
        'md' => [
            'folder' => 'uploads/articles/md/',
            'size' => [560, 420]
            ],
        'sm' => [
            'folder' => 'uploads/articles/sm/',
            'size' => [180, 135]
            ],
        'xs' => [
            'folder' => 'uploads/articles/xs/',
            'size' => [90, 68]
            ]
    ],
    'slides_image_sizes' => [
        'lg' => [
            'folder' => 'uploads/slides/lg/',
            'size' => [800, 450]
            ],
        'md' => [
            'folder' => 'uploads/slides/md/',
            'size' => [640, 360]
            ],
        'sm' => [
            'folder' => 'uploads/slides/sm/',
            'size' => [320, 180]
            ],
        'xs' => [
            'folder' => 'uploads/slides/xs/',
            'size' => [160, 90]
            ]
    ],


    'avatars_image_sizes' => [
        'lg' => [
            'folder' => 'uploads/avatars/lg/',
            'size' => [384, 384]
            ],
        'md' => [
            'folder' => 'uploads/avatars/md/',
            'size' => [192, 192]
            ],
        'sm' => [
            'folder' => 'uploads/avatars/sm/',
            'size' => [96, 96]
            ],
        'xs' => [
            'folder' => 'uploads/avatars/xs/',
            'size' => [48, 48]
            ]
    ],
    'products_image_sizes' => [
        'lg' => [
            'folder' => 'uploads/products/lg/',
            'size' => [384, 384]
            ],
        'md' => [
            'folder' => 'uploads/products/md/',
            'size' => [192, 192]
            ],
        'sm' => [
            'folder' => 'uploads/products/sm/',
            'size' => [96, 96]
            ],
        'xs' => [
            'folder' => 'uploads/products/xs/',
            'size' => [48, 48]
            ]
    ],

    'wysiwyg_image_sizes' => [
        'lg' => [
            'folder' => 'uploads/wysiwyg/lg/',
            'size' => [1280, 960]
            ]
    ],

    'page_views' => [
        'simple' => 'Simple',
        'about'  => 'About'
    ],

    'user_roles' => [
        'user' => 'User',
        'editor' => 'Editor',
        'author' => 'Author',
        'admin'  => 'Admin',
        'super-admin'  => 'SuperAdmin',
    ],

    'version' => '0.0.01',
    'version_lang' => '0.0.01',

];
