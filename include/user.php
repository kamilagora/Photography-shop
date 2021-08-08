<?php

class User
{

    private $_user_id;
    private $_user_data;

    public function __construct(int $user_id)
    {
        $this->_user_id = $user_id;
        $this->UpdateData();
    }


    public function GetData(): array
    {
        return $this->_user_data;
    }

    public function GetId(): int
    {
        return $this->_user_id;
    }

    private function UpdateData(): void
    {
        $database = MysqliDb::getInstance();
        $database->where("id", $this->_user_id);
        $this->_user_data = $database->getOne("users");

        if ($this->_user_data === null) {
            throw new Exception("User with ID = {$this->_user_id} not found");
        }
    }

    public function changeEmail(string $email, &$err_message): bool
    {

        $database = MysqliDb::getInstance();
        $database->where("email", $email);
        $row = $database->getOne("users");

        if ($row !== null) {
            $err_message = " This email is already taken ";
            return false;
        }

        $database->where("id", $this->_user_data["id"]);
        $database->update("users", [
            "email" => $email,
            "is_activated" => 1, // TODO: Add email verification
        ]);

        $this->UpdateData();
        return true;
    }

    public function changePassword(string $current_password, string $password, &$err_message): bool
    {

        if (!password_verify($current_password, $this->_user_data["pass_hash"])) {
            $err_message = "Invalid current password";
            return false;
        }

        $pass_hash = password_hash($password, PASS_HASH_ALG);

        $database = MysqliDb::getInstance();
        $database->where("id", $this->_user_data["id"]);
        $database->update("users", [
            "pass_hash" => $pass_hash,
        ]);

        $this->UpdateData();
        return true;
    }
}
