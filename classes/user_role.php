<?php

class UserRole
{
    public function isAdmin()
    {
        return isset($_SESSION['role']) && $_SESSION['role'] == 'admin';
    }


    public function name()
    {

        if (isset($_SESSION['user_name'])) {
            return $_SESSION['user_name'];
        } else {
            return $_SESSION['user_name'] = 'gust';
        };
    }
}
