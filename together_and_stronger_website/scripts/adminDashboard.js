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

adminInfoBtn.addEventListener('click', () => {
    removeActiveClass();
    adminInfoBtn.classList.add('active');
    adminInfo.style.display = 'block';
    manageUsers.style.display = 'none';
});

manageActivitiesBtn.addEventListener('click', () => {
    removeActiveClass();
    manageActivitiesBtn.classList.add('active');
    adminInfo.style.display = 'none';
    manageUsers.style.display = 'none';
});

manageClientsBtn.addEventListener('click', () => {
    removeActiveClass();
    manageClientsBtn.classList.add('active');
    adminInfo.style.display = 'none';
    manageUsers.style.display = 'none';
});

manageUsersBtn.addEventListener('click', () => {
    removeActiveClass();
    manageUsersBtn.classList.add('active');
    adminInfo.style.display = 'none';
    manageUsers.style.display = 'block';
});