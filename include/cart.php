<?php

class Cart
{

    public static function GetProducts(): Generator
    {


        $database = MysqliDb::getInstance();
        $database->where("user_id", Me::GetUser()->GetId());
        $database->orderBy("id", "DESC");
        foreach ($database->get("cart") as $row) {
            yield new Product($row["product_id"]);
        }
    }

    public static function AddToCart(int $product_id): bool
    {
        try {
            $x = new Product($product_id);
        } catch (Exception $ex) {
            return false;
        }

        $user_id = Me::GetUser()->GetData()["id"];
        $database = MysqliDb::getInstance();
        $database->insert("cart", [
            "user_id" => $user_id,
            "product_id" => $product_id,
        ]);
        return true;
    }

    public static function RemoveFromCart(int $product_id): bool
    {
        $database = MysqliDb::getInstance();
        $database->where("user_id", Me::GetUser()->GetData()["id"]);
        $database->where("product_id", $product_id);
        $database->delete("cart", 1);
        return true;
    }


    public static function ClearCart(): void
    {
        $database = MysqliDb::getInstance();
        $database->where("user_id", Me::GetUser()->GetData()["id"]);
        $database->delete("cart");
    }
}
