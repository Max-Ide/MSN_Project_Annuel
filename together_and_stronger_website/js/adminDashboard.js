const sidebarButtons = document.querySelectorAll('.sidebar-admin-btn');
const adminInfoBtn = document.getElementById('admin-info-btn');
const manageActivitiesBtn = document.getElementById('manage-activities-btn');
const manageClientsBtn = document.getElementById('manage-clients-btn');
const manageUsersBtn = document.getElementById('manage-users-btn');
const adminInfo = document.getElementById('admin-info');
const manageActivities = document.getElementById('manage-activities');
const manageClients = document.getElementById('manage-clients');
const manageUsers = document.getElementById('manage-users');

function removeActiveClass() {
  sidebarButtons.forEach((button) => {
    button.classList.remove('active');
  });
}

function hideAllSections() {
  adminInfo.style.display = 'none';
  manageActivities.style.display = 'none';
  manageClients.style.display = 'none';
  manageUsers.style.display = 'none';
}

adminInfoBtn.addEventListener('click', () => {
    removeActiveClass();
    adminInfoBtn.classList.add('active');
    hideAllSections();
    adminInfo.style.display = 'block';
});

manageActivitiesBtn.addEventListener('click', () => {
    removeActiveClass();
    manageActivitiesBtn.classList.add('active');
    adminInfo.style.display = 'none';
    manageActivities.style.display = 'block';
    manageClients.style.display = 'none';
    manageUsers.style.display = 'none';
});

manageClientsBtn.addEventListener('click', () => {
  removeActiveClass();
  manageClientsBtn.classList.add('active');
  adminInfo.style.display = 'none';
  manageActivities.style.display = 'none';
  manageClients.style.display = 'block';
  manageUsers.style.display = 'none';
});

manageUsersBtn.addEventListener('click', () => {
  removeActiveClass();
  manageUsersBtn.classList.add('active');
  adminInfo.style.display = 'none';
  manageActivities.style.display = 'none';
  manageClients.style.display = 'none';
  manageUsers.style.display = 'block';
});

document.addEventListener('DOMContentLoaded', () => {
  const deleteButtons = document.querySelectorAll('.delete-activity');
  deleteButtons.forEach((button) => {
    button.addEventListener('click', () => {
      const activityId = button.dataset.id;
      deleteActivity(activityId);
    });
  });
});

function deleteActivity(activityId) {
  const xhr = new XMLHttpRequest();
  xhr.open('POST', 'entities/activities/delete_activity.php', true);
  xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
  xhr.onload = function () {
    if (xhr.status === 200) {
      const response = JSON.parse(xhr.responseText);
      if (response.status === 'success') {
        alert('Activité supprimée avec succès.');
        const tableRow = document.querySelector(`button[data-id="${activityId}"]`).closest("tr");
        tableRow.parentNode.removeChild(tableRow);
      } else {
        alert('Une erreur s\'est produite lors de la suppression de l\'activité.');
      }
    } else {
      alert('Une erreur s\'est produite lors de la suppression de l\'activité.');
    }
  };
  xhr.send('activity_id=' + activityId);
}

function editActivity(activityId) {
  const modal = document.createElement("div");
  modal.setAttribute("id", "edit-modal");
  modal.style.display = "block";
  modal.style.width = "100%";
  modal.style.height = "100%";
  modal.style.backgroundColor = "rgba(0,0,0,0.5)";
  modal.style.position = "fixed";
  modal.style.top = "0";
  modal.style.left = "0";
  modal.style.zIndex = "1000";
  modal.innerHTML = `
    <div style="width: 50%; margin: 100px auto; background: white; padding: 20px; border-radius: 4px;">
      <h3>Modifier l'activité</h3>
      <form id="edit-activity-form">
      </form>
    </div>
  `;
  document.body.appendChild(modal);

  const xhr = new XMLHttpRequest();
  xhr.open("GET", "entities/activities/get_activity.php?id=" + activityId, true);
  xhr.onload = function () {
    if (xhr.status === 200) {
      document.getElementById("edit-activity-form").innerHTML = xhr.responseText;
    } else {
      alert("Une erreur s'est produite lors du chargement du formulaire de modification.");
    }
  };
  xhr.send();

  document.body.addEventListener("submit", function (event) {
    if (event.target.id === "edit-activity-form") {
      event.preventDefault();

      const formData = new FormData(event.target);
      const activityId = formData.get("id");
      const activityNom = formData.get("name");
      const activityDescription = formData.get("description");
      const activityPrice = formData.get("price_per_participants");

      const xhr = new XMLHttpRequest();
      xhr.open("POST", "entities/activities/update_activity.php", true);
      xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
      xhr.onload = function () {
        if (xhr.status === 200) {
          const response = JSON.parse(xhr.responseText);
          if (response.status === "success") {
            alert("L'activité a été mise à jour avec succès.");
            location.reload();
          } else {
            console.error("Erreur :", response.message);
            alert("Une erreur s'est produite lors de la mise à jour de l'activité.");
          }
        } else {
          console.error("Erreur xhr :", xhr.status, xhr.statusText);
          alert("Une erreur s'est produite lors de la mise à jour de l'activité.");
        }
      };
      xhr.send(`id=${activityId}&name=${encodeURIComponent(activityNom)}&description=${encodeURIComponent(activityDescription)}&price_per_participants=${encodeURIComponent(activityPrice)}`);
    }
  });
}

function createActivity() {
  const modal = document.createElement("div");
  modal.setAttribute("id", "add-modal");
  modal.style.display = "block";
  modal.style.width = "100%";
  modal.style.height = "100%";
  modal.style.backgroundColor = "rgba(0,0,0,0.5)";
  modal.style.position = "fixed";
  modal.style.top = "0";
  modal.style.left = "0";
  modal.style.zIndex = "1000";
  modal.innerHTML = `
    <div style="width: 50%; margin: 100px auto; background: white; padding: 20px; border-radius: 4px;">
      <h3>Ajouter une activité</h3>
      <form id="add-activity-form">
        <label for="nom">Nom de l'activité :</label>
        <input type="text" name="name" required>
        <label for="description">Description de l'activité :</label>
        <textarea name="description" required></textarea>
        <label for="image_url">Image de l'activité :</label>
        <input type="text" name="image_url" required>
        <label for="duree">Durée :</label>
        <input type="text" name="duration" required>
        <label for="min_participants">Nombre minimum de participants :</label>
        <input type="number" name="min_participants" required>
        <label for="max_participants">Nombre maximum de participants :</label>
        <input type="number" name="max_participants" required>
        <label for="localisation">Localisation :</label>
        <input type="text" name="id_location" required>
        <label for="prix_par_participants">Prix par participants :</label>
        <input type="number" name="price_per_participants" required>
        <button type="submit">Ajouter</button>
      </form>
    </div>
  `;
  document.body.appendChild(modal);
}

document.getElementById("add-activity").addEventListener("click", createActivity);

document.body.addEventListener("submit", function (event) {
  if (event.target.id === "add-activity-form") {
    event.preventDefault();

    const formData = new FormData(event.target);
    const activityNom = formData.get("name");
    const activityDescription = formData.get("description");
    const activityImage = formData.get("image_url");
    const activityDuree = formData.get("duration");
    const activityMinParticipants = formData.get("min_participants");
    const activityMaxParticipants = formData.get("max_participants");
    const activityLocalisation = formData.get("id_location");
    const activityPrix = formData.get("price_per_participants");

    const xhr = new XMLHttpRequest();
    xhr.open("POST", "entities/activities/create_activity.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onload = function () {
      if (xhr.status === 200) {
        const response = JSON.parse(xhr.responseText);
        if (response.status === "success") {
          alert("L'activité a été ajoutée avec succès.");
          location.reload();
        } else {
          alert("Une erreur s'est produite lors de l'ajout de l'activité.");
        }
      } else {
        alert("Une erreur s'est produite lors de l'ajout de l'activité.");
      }
    };
    xhr.send(`name=${encodeURIComponent(activityNom)}&description=${encodeURIComponent(activityDescription)}&image_url=${encodeURIComponent(activityImage)}&duration=${encodeURIComponent(activityDuree)}&min_participants=${activityMinParticipants}&max_participants=${activityMaxParticipants}&id_location=${encodeURIComponent(activityLocalisation)}&price_per_participants=${activityPrix}`);
  }
});

document.querySelectorAll('.ban-user').forEach(function(button) {
  button.addEventListener('click', function(event) {
    var userId = event.target.getAttribute('data-id');

    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'ban_user.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.send('id=' + encodeURIComponent(userId));

    xhr.onload = function() {
      if (xhr.status === 200) {
        alert('Utilisateur banni avec succès.');
      } else {
        alert('Une erreur s\'est produite lors du bannissement de l\'utilisateur.');
      }
    };
  });
});

document.querySelectorAll('.unban-user').forEach(function(button) {
  button.addEventListener('click', function(event) {
    var userId = event.target.getAttribute('data-id');

    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'unban_user.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.send('id=' + encodeURIComponent(userId));

    xhr.onload = function() {
      if (xhr.status === 200) {
        alert('Utilisateur débanni avec succès.');
      } else {
        alert('Une erreur s\'est produite lors du débannissement de l\'utilisateur.');
      }
    };
  });
});
