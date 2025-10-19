function toggleSidebar() {
  document.body.classList.toggle('sidebar-open');
}

document.addEventListener('DOMContentLoaded', function() {
  var sidebarToggle = document.getElementById('sidebarToggle');
  if (sidebarToggle) {
    sidebarToggle.addEventListener('click', toggleSidebar);
  }
  var sidebarClose = document.getElementById('sidebarClose');
  if (sidebarClose) {
    sidebarClose.addEventListener('click', toggleSidebar);
  }
});

// Add other shared admin JS functions below
