<?php
declare(strict_types=1);
header('Content-Type: application/json; charset=utf-8');
require_once __DIR__ . '/../config/db.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['error' => 'Method not allowed']);
    exit;
}
$data = json_decode(file_get_contents('php://input'), true) ?: $_POST;
$name = trim((string)($data['name'] ?? ''));
$phone = trim((string)($data['phone'] ?? ''));
if ($name === '' || !preg_match('/^[0-9 +()\-]{8,30}$/', $phone)) {
    http_response_code(422);
    echo json_encode(['error' => 'Name and a valid phone number are required']);
    exit;
}
$stmt = db()->prepare('INSERT INTO contacts (full_name, phone, email, address, note, build_snapshot) VALUES (?, ?, ?, ?, ?, ?)');
$stmt->execute([$name, $phone, filter_var($data['email'] ?? '', FILTER_VALIDATE_EMAIL) ?: null, trim((string)($data['address'] ?? '')), trim((string)($data['note'] ?? '')), json_encode($data['build'] ?? [], JSON_UNESCAPED_UNICODE)]);
echo json_encode(['success' => true, 'message' => 'Your request has been submitted.']);
