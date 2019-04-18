<?php

if (!function_exists('config_path')) {
    /**
     * Get the configuration path.
     *
     * @param  string $path
     * @return string
     */
    function config_path($path = '')
    {
        return app()->basePath() . '/config' . ($path ? '/' . $path : $path);
    }
}

if (!function_exists('encryptPassword')) {
    /**
     * Encrypt password.
     *
     * @param  string $password
     * @return string
     */
    function encryptPassword($password)
    {
        return app('hash')->make($password);
    }
}

if (!function_exists('matchPassword')) {
    /**
     * Match password
     *
     * @param  string $password
     * @return boolean
     */
    function matchPassword($password, $hashedPassword)
    {
        return app('hash')->check($password, $hashedPassword);
    }
}
