<?php

namespace App\Controllers;

use App\Core\App;

class UserController
{
    public function index()
    {
        $users = App::get('database')->all('users');

        return view('index', compact('users'));
    }

    public function store()
    {
        if (empty(App::get('database')->verify('users', 'email', $_POST['email']))) {
            $_POST['updated_at'] = date('Y-m-d H:i:s');
            App::get('database')->insert('users', $_POST);
        }

        return redirect('/');
    }

    public function update()
    {
        $_POST['updated_at'] = date('Y-m-d H:i:s');
        App::get('database')->update('users', $_POST);

        return redirect('/');
    }

    public function delete()
    {
        App::get('database')->delete('users', $_POST);

        return redirect('/');
    }
}
