<?php
declare(strict_types=1);
session_start();
require_once __DIR__ . '/../config/db.php';
if (!isset($_SESSION['admin_id'])) {
    http_response_code(401);
    ?><!doctype html><html lang="vi"><body><h1>Quản trị ByteBuild</h1><p>Vui lòng đăng nhập quản trị. Hãy cấu hình cơ chế xác thực an toàn trước khi triển khai.</p></body></html><?php
    exit;
}
$stats = [
 'components' => (int)db()->query('SELECT COUNT(*) FROM components')->fetchColumn(),
 'builds' => (int)db()->query('SELECT COUNT(*) FROM builds')->fetchColumn(),
 'orders' => (int)db()->query('SELECT COUNT(*) FROM contacts')->fetchColumn(),
 'pending' => (int)db()->query("SELECT COUNT(*) FROM contacts WHERE status = 'New'")->fetchColumn(),
];
?><!doctype html><html lang="vi"><head><meta charset="utf-8"><title>Quản trị ByteBuild</title></head><body><h1>Bảng điều khiển ByteBuild</h1><?php foreach ($stats as $key => $value): ?><p><?=htmlspecialchars(['components'=>'Linh kiện','builds'=>'Cấu hình','orders'=>'Yêu cầu','pending'=>'Đang chờ'][$key] ?? $key)?>: <?= $value ?></p><?php endforeach; ?></body></html>
