<?php
class Store
{

    public static function GetProducts(): Generator
    {
        $database = MysqliDb::getInstance();
        $database->orderBy("id", "DESC");
        foreach ($database->get("products") as $row) {
            yield new Product($row["id"]);
        }
    }
}
