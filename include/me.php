<?php
class Me
{

    private static $_user = null;

    public static function SetUser(User $user): void
    {
        Me::$_user = $user;
    }

    public static function GetUser(): User
    {
        return Me::$_user;
    }

    public static function IsLoggedIn(): bool
    {
        return Me::$_user !== null;
    }
}
