<?php
/**
 * This file hold all routes definitions.
 *
 * PHP version 7
 *
 * @category Config
 * @package  Config
 * @author   WCS <contact@wildcodeschool.fr>
 * @link     https://github.com/WildCodeSchool/simple-mvc
 */

$routes = [
    'Security' => [ // Controller
        ['index', '/', ['GET', 'POST']], // action, url, method
        ['disconnect', '/disconnect', ['GET', 'POST']] // action, url, method
    ],
    'User' => [ // Controller
        ['home', '/home', ['GET', 'POST']], // action, url, method
        ['profile', '/profile', ['GET', 'POST']], // action, url, method
        ['login', '/login', ['GET', 'POST']], // action, url, method
        ['editProfile', '/edit', ['GET', 'POST']], // action, url, method
        ['showTrombinoscope', '/trombinoscope', ['GET', 'POST']], // action, url, method
        ['showProfile', '/showProfile/{id:\d+}', ['GET']], // action, url, method
        ['initPassword', '/init', ['GET', 'POST']], // action, url, method
        ['showCgu', '/mentions-legales', ['GET']], // action, url, method
    ],

    'Staff' => [ // Controller
        ['user', '/staff/user', ['GET', 'POST']], // action, url, method
        ['userDelete', '/staff/user/delete{id}', ['GET', 'POST']], // action, url, method
        ['userModify', '/staff/user/modify{id}', ['GET', 'POST']], // action, url, method
        ['changePhoto', '/staff/user/changePhoto{id}', ['GET', 'POST']], // action, url, method
    ],

    'Article' => [ // Controller
        ['createArticle', '/article/create', ['GET', 'POST']],// action, url, method
        ['articles', '/articles', ['GET', 'POST']],// action, url, method
        ['articleById', '/articles/{id:\d+}', ['GET', 'POST']],// action, url, method
        ['suppressionArticle', '/articles/delete/{id:\d+}', ['GET']],// action, url, method
        ['deleteComment', '/comments/delete/{id:\d+}', ['GET']],// action, url, method
        ['articleView', '/article/view', ['GET', 'POST']], // action, url, method
        ['articleValidate', '/article/view/{id:\d+}', ['GET', 'POST']], // action, url, method
        ['articleDelete', '/article/delete/{id:\d+}', ['GET', 'POST']], // action, url, method
        ['articleByCategory', '/articles/category/{id:\d+}', ['GET']],// action, url, method
        ['editCategory', '/edit/category/{id:\d+}', ['GET', 'POST']], // action, url, method
        ['deleteCategory', '/delete/category/{id:\d+}', ['GET', 'POST']] // action, url, method
    ]
];
