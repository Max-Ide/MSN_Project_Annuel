<?php
require_once __DIR__ . "/database/connection.php";

$sql = "SELECT * FROM companies";
$result = $conn->query($sql);
?>

<table>
  <thead>
    <tr>
      <th>ID</th>
      <th>Nom</th>
      <th>Email</th>
      <th>Adresse</th>
      <th>Numéro SIRET</th>
    </tr>
  </thead>
  <tbody>
    <?php while ($row = $result->fetch_assoc()): ?>
      <tr>
        <td><?= $row['id_company'] ?></td>
        <td><?= $row['name'] ?></td>
        <td><?= $row['email'] ?></td>
        <td><?= $row['address'] ?></td>
        <td><?= $row['num_siret'] ?></td>
      </tr>
    <?php endwhile; ?>
  </tbody>
</table>

<?php
?>