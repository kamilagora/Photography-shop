<?php

class Session
{

    public static function CreateSession(int $user_id, int $expire_days, &$token)
    {
        $token = bin2hex(random_bytes(16));
        $token_hash = hash(TOKEN_HASH_ALGO, $token);
        $expire_time = time() + $expire_days * 24 * 60 * 60;
        $database = MysqliDb::getInstance();
        $database->insert('sessions', [

            "user_id" => $user_id,
            "token_hash" => $token_hash,
            "create_time" => time(),
            "expire_time" => $expire_time,
        ]);

        return true;
    }

    public static function ValidateSession(string $token, &$user_id): bool
    {

        $token_hash = hash(TOKEN_HASH_ALGO, $token);
        $database = MysqliDb::getInstance();
        $database->where("token_hash", $token_hash);
        $database->where("expire_time", time(), ">");
        $row = $database->getOne("sessions");

        if ($row === null) {
            return false;
        }

        $user_id = $row["user_id"];
        return true;
    }

    public static function DestroySession(string $token): bool
    {
        $token_hash = hash(TOKEN_HASH_ALGO, $token);
        $database = MysqliDb::getInstance();
        $database->where("token_hash", $token_hash);
        $database->delete("sessions");

        return true;
    }

    public static function DestroySessionByUser(int $user_id): bool
    {

        $database = MysqliDb::getInstance();
        $database->where("user_id", $user_id);
        $database->delete("sessions");

        return true;
    }
}
