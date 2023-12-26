<?php

class AdminPanel {

    private $conn;
    private $userTable = 'page_user';
    private $banListTable = 'ban_list';

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function getUserList() {
        $query = "SELECT uid, user_name FROM " . $this->userTable;
        $result = $this->conn->query($query);

        if ($result) {
            $users = $result->fetch_all(MYSQLI_ASSOC);
            $result->free();
            return $users;
        } else {
            return [];
        }
    }

    public function banUser($userId, $duration) {
        // Assuming $duration is 'day', 'week', or 'month'
        $expiryDate = date('Y-m-d H:i:s', strtotime("+1 $duration"));

        $query = "INSERT INTO ";
        $query .= $this->banListTable;
        $query .= " (user_id, expiry_date) ";
        $query .= " VALUES (?, ?) ";

        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("is", $userId, $expiryDate);

        if ($stmt->execute()) {
            $stmt->close();
            return true;
        } else {
            return false;
        }
    }


}

$users = $adminPanel->getUserList();

echo "<h2>User List:</h2>";
echo "<ul>";
foreach ($users as $user) {
    echo "<li>{$user['user_name']} - <a href='ban_user.php?uid={$user['uid']}'>Ban</a></li>";
}
echo "</ul>";

if (isset($_GET['uid'])) {
    $userId = $_GET['uid'];
    $result = $adminPanel->banUser($userId, 'week');

    if ($result) {
        echo "User successfully banned!";
    } else {
        echo "Error banning user.";
    }
}

?>
