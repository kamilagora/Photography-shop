<?php
class Order
{
    public static function Create(int $user_id, array $data): int
    {
        $database = MysqliDb::getInstance();
        return (int) $database->insert("orders", [
            "user_id" => $user_id,
            "json_data" => json_encode($data),
            "is_paid" => 0,
            "is_shipped" => 0,
        ]);
    }

    public static function GetData(int $order_id): array
    {
        $database = MysqliDb::getInstance();
        $database->where("id", $order_id);
        $row = $database->getOne("orders");

        if ($row === null) {
            throw new Exception("Missing order ID = $order_id");
        }

        return json_decode($row["json_data"], true);
    }

    public static function Update(int $order_id, bool $is_paid, bool $is_shipped): void
    {
        $database = MysqliDb::getInstance();
        $database->where("id", $order_id);
        $database->update("orders", [
            "is_paid" => $is_paid ? 1 : 0,
            "is_shipped" => $is_shipped ? 1 : 0,
        ]);
    }

    public static function GetOrders(int $user_id): array
    {
        $database = MysqliDb::getInstance();
        $database->where("user_id", $user_id);
        $database->orderBy("id", "DESC");
        return $database->get("orders");
    }
}
