<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'RH') {
    header("Location: login.php");
    exit();
}

require_once 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $request_id = $_POST['request_id'];
    $action = $_POST['action'];

    $status = ($action == 'approve') ? 'Approved' : 'Declined';
    $stmt = $pdo->prepare("UPDATE requests SET status = :status WHERE id = :id");
    $stmt->bindParam(':status', $status);
    $stmt->bindParam(':id', $request_id);
    $stmt->execute();
}

$stmt = $pdo->prepare("SELECT r.id, u.username, r.nom, r.prenom, r.cin, r.date_naissance, r.lieu_naissance, r.adresse, r.status FROM requests r JOIN users u ON r.user_id = u.id");
$stmt->execute();
$requests = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="assets/css/styles.css">
</head>
<body>
    <div class="container">
        <h2>Dashboard</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Username</th>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>CIN</th>
                    <th>Date Naissance</th>
                    <th>Lieu Naissance</th>
                    <th>Adresse</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($requests as $request): ?>
                <tr>
                    <td><?php echo htmlspecialchars($request['id']); ?></td>
                    <td><?php echo htmlspecialchars($request['username']); ?></td>
                    <td><?php echo htmlspecialchars($request['nom']); ?></td>
                    <td><?php echo htmlspecialchars($request['prenom']); ?></td>
                    <td><?php echo htmlspecialchars($request['cin']); ?></td>
                    <td><?php echo htmlspecialchars($request['date_naissance']); ?></td>
                    <td><?php echo htmlspecialchars($request['lieu_naissance']); ?></td>
                    <td><?php echo htmlspecialchars($request['adresse']); ?></td>
                    <td><?php echo htmlspecialchars($request['status']); ?></td>
                    <td>
                        <?php if ($request['status'] == 'Pending'): ?>
                        <form action="dashboard.php" method="post" style="display:inline-block;">
                            <input type="hidden" name="request_id" value="<?php echo $request['id']; ?>">
                            <button type="submit" name="action" value="approve">Approve</button>
                        </form>
                        <form action="dashboard.php" method="post" style="display:inline-block;">
                            <input type="hidden" name="request_id" value="<?php echo $request['id']; ?>">
                            <button type="submit" name="action" value="decline">Decline</button>
                        </form>
                        <?php endif; ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
       
