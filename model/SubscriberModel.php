<?php
class SubscriberModel
{
    private $conn;

    public function __construct(PDO $conn)
    {
        $this->conn = $conn;
    }

    public function writeSubscriber($email, $name, $lastName, $status)
    {
        $stmt = $this->conn->prepare("SELECT * FROM subscribers WHERE email = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        if ($stmt->rowCount() == 0) {
            $stmt = $this->conn->prepare("INSERT INTO subscribers (email, name, lastname, status) VALUES (:email, :name, :lastName, :status)");
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':lastName', $lastName);
            $stmt->bindParam(':status', $status);
            $stmt->execute();

            return json_encode(['status' => 'success', 'message' => 'Subscriber added successfully.']);
        } else {
            return json_encode(['status' => 'fail', 'message' => 'Subscriber already exists.']);
        }
    }

    public function getAllSubscribers($page, $pageSize)
    {
        $offset = ($page - 1) * $pageSize;

        // Fetch subscribers
        $stmt = $this->conn->prepare("SELECT * FROM subscribers LIMIT :pageSize OFFSET :offset");
        $stmt->bindParam(':pageSize', $pageSize, PDO::PARAM_INT);
        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();

        $subscribers = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Fetch total count
        $countStmt = $this->conn->prepare("SELECT COUNT(*) as total FROM subscribers");
        $countStmt->execute();
        $total = $countStmt->fetch(PDO::FETCH_ASSOC)['total'];

        // Process subscribers data
        foreach ($subscribers as &$subscriber) {
            $subscriber['status'] = $subscriber['status'] == 1 ? true : false;
        }

        return json_encode(['status' => 'success', 'data' => $subscribers, 'total' => $total]);
    }
}
