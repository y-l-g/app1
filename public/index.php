<?php
$dbHost = trim((getenv('MYSQL_SERVICE_HOST')));
$dbName = trim(file_get_contents(getenv('MYSQL_DATABASE_FILE')));
$dbUser = trim(file_get_contents(getenv('MYSQL_USER_FILE')));
$dbPassword = trim(file_get_contents(getenv('MYSQL_PASSWORD_FILE')));

$pdo = new PDO(
    "mysql:host=$dbHost;dbname=$dbName;charset=utf8mb4",
    $dbUser,
    $dbPassword,
);
$pdo->exec("CREATE TABLE IF NOT EXISTS items (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL
)");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['add']) && !empty($_POST['item'])) {
        $stmt = $pdo->prepare("INSERT INTO items (name) VALUES (:name)");
        $stmt->execute(['name' => $_POST['item']]);
    }
    if (isset($_POST['delete'])) {
        $stmt = $pdo->prepare("DELETE FROM items WHERE id = :id");
        $stmt->execute(['id' => $_POST['delete']]);
    }
}

$result = $pdo->query("SELECT * FROM items");
?>

<form method="post">
    <input
        type="text"
        name="item"
    >
    <button
        type="submit"
        name="add"
    >Add</button>
</form>

<ul>
    <?php while ($row = $result->fetch(PDO::FETCH_ASSOC)): ?>
        <li>
            <?= htmlspecialchars($row['name']) ?>
            <form
                method="post"
                style="display:inline;"
            >
                <button
                    type="submit"
                    name="delete"
                    value="<?= $row['id'] ?>"
                >Delete</button>
            </form>
        </li>
    <?php endwhile; ?>
</ul>