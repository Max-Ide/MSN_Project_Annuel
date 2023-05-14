<?php
require_once __DIR__ . "/database/connection.php";

$sql = "SELECT * FROM employees";
$result = $conn->query($sql);
?>

<table>
  <thead>
    <tr>
      <th>ID</th>
      <th>Nom</th>
      <th>Prénom</th>
      <th>Email</th>
      <th>Téléphone</th>
      <th>Entreprise</th>
      <th>Actions</th>
    </tr>
  </thead>
  <tbody>
    <?php while ($row = $result->fetch_assoc()): ?>
      <tr>
        <td><?= $row['id'] ?></td>
        <td><?= $row['lastname'] ?></td>
        <td><?= $row['firstname'] ?></td>
        <td><?= $row['email'] ?></td>
        <td><?= $row['telephone'] ?></td>
        <td><?= $row['id_company'] ?></td>
        <td>
        <button class="ban-user" data-id="<?= $row['user_id'] ?>">Bannir</button>
        <button class="unban-user" data-id="<?= $row['user_id'] ?>">Débannir</button>
        </td>
      </tr>
    <?php endwhile; ?>
  </tbody>
</table>

<?php
?>