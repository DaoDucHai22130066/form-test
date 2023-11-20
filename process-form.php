<?php

// Kiểm tra xem có phải là phương thức POST không
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Lấy dữ liệu từ biểu mẫu
    $name = htmlspecialchars($_POST["name"]);
    $email = htmlspecialchars($_POST["email"]);
    $message = htmlspecialchars($_POST["message"]);

    // Kiểm tra và xử lý dữ liệu (ví dụ: lưu vào cơ sở dữ liệu)
    // Note: Trong thực tế, bạn cần thực hiện kiểm tra bảo mật và xác thực dữ liệu hợp lý hơn.

    // Kết nối đến cơ sở dữ liệu (điều này chỉ là ví dụ đơn giản, thực tế bạn cần thay thế bằng thông tin đăng nhập và đường dẫn cụ thể)
    $servername = "localhost";
    $username = "your_username";
    $password = "your_password";
    $dbname = "your_database";

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        // Đặt chế độ lỗi PDO thành Exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Chuẩn bị truy vấn SQL
        $stmt = $conn->prepare("INSERT INTO messages (name, email, message) VALUES (:name, :email, :message)");

        // Gán giá trị vào các tham số
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':message', $message);

        // Thực thi truy vấn
        $stmt->execute();

        echo "Dữ liệu đã được lưu vào cơ sở dữ liệu thành công!";
    } catch (PDOException $e) {
        echo "Lỗi: " . $e->getMessage();
    } finally {
        // Đóng kết nối
        $conn = null;
    }
} else {
    // Nếu không phải là phương thức POST, chuyển hướng hoặc xử lý theo cách khác tùy thuộc vào yêu cầu của bạn
    echo "Phương thức không hợp lệ!";
}

?>
