<?php

class GroceryManager {

    private $conn;
    private $groceryTable = 'grocery_item';

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function validate($quantity, $price, $itemName, $imgUrl, $isVeg) {
        $error = false;
        $errMsg = [];

        if (empty($quantity)) {
            $error = true;
            $errMsg['quantity'] = "Quantity is required";
        }

        if (empty($price)) {
            $error = true;
            $errMsg['price'] = "Price is required";
        }

        if (empty($itemName)) {
            $error = true;
            $errMsg['itemName'] = "Item name is required";
        }

        if (empty($imgUrl)) {
            $error = true;
            $errMsg['imgUrl'] = "Image URL is required";
        }

        if (!isset($isVeg)) {
            $error = true;
            $errMsg['isVeg'] = "Vegetarian status is required";
        }

        return [
            "error" => $error,
            "errMsg" => $errMsg
        ];
    }

    public function create($quantity, $price, $itemName, $imgUrl, $isVeg) {
        $validationResult = $this->validate($quantity, $price, $itemName, $imgUrl, $isVeg);

        if (!$validationResult['error']) {
            $query = "INSERT INTO ";
            $query .= $this->groceryTable;
            $query .= " (quantity, price, item_name, img_url, is_veg) ";
            $query .= " VALUES (?, ?, ?, ?, ?) ";

            $stmt = $this->conn->prepare($query);

            $stmt->bind_param("iisssi", $quantity, $price, $itemName, $imgUrl, $isVeg);

            if ($stmt->execute()) {
                $stmt->close();
                return [
                    'success' => true
                ];
            } else {
                return [
                    'success' => false,
                    'errMsg' => "Failed to insert grocery item"
                ];
            }
        } else {
            return [
                'success' => false,
                'errMsg' => $validationResult['errMsg']
            ];
        }
    }

    public function getAllGroceries() {
        $query = "SELECT gid, quantity, price, item_name, img_url, is_veg FROM " . $this->groceryTable;

        $result = $this->conn->query($query);

        if ($result) {
            $groceries = $result->fetch_all(MYSQLI_ASSOC);
            $result->free();
            return $groceries;
        } else {
            return [];
        }
    }


}

?>
O