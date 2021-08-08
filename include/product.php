<?php
class Product
{

    private $_prod_id;
    private $_prod_data;

    public function __construct(int $product_id)
    {
        $this->_prod_id = $product_id;
        $this->UpdateData();
    }

    public function GetData(): array
    {
        return $this->_prod_data;
    }

    private function UpdateData(): void
    {
        $database = MysqliDb::getInstance();
        $database->where("id", $this->_prod_id);
        $this->_prod_data = $database->getOne("products");

        if ($this->_prod_data === null) {
            throw new Exception("Product with ID = {$this->_prod_id} not found");
        }
    }

    public function DecQuantity(): bool
    {
        $database = MysqliDb::getInstance();
        $database->where("id", $this->_prod_id);
        return $database->update("products", [
            "quantity" => $database->dec(),
        ]);
    }
}
