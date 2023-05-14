<?php
require_once __DIR__ . "/database/connection.php";

$sql = "SELECT * FROM activities";
$result = $conn->query($sql);
?>

<table>
  <thead>
    <tr>
      <th>ID</th>
      <th>Nom</th>
      <th>Description</th>
      <th>Prix par participants</th>
      <th>Localisation</th>
      <th>Actions</th>
    </tr>
  </thead>
  <tbody>
    <?php while ($row = $result->fetch_assoc()): ?>
      <tr>
        <td><?= $row['id'] ?></td>
        <td><?= $row['name'] ?></td>
        <td><?= $row['description'] ?></td>
        <td><?= $row['price_per_participants'] ?></td>
        <td><?= $row['id_location'] ?></td>
        <td>
          <button class="edit-activity" data-id="<?= $row['id'] ?>" onclick="editActivity(<?= $row['id'] ?>)">Edit</button>
          <button class="delete-activity" data-id="<?= $row['id'] ?>">Delete</button>
        </td>
      </tr>
    <?php endwhile; ?>
  </tbody>
</table>

<?php
?>