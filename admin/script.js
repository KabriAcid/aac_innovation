function openSidebar() {
  document.body.classList.add('sidebar-open');
  var overlay = document.getElementById('sidebarOverlay');
  if (overlay) overlay.classList.remove('hidden');
}

function closeSidebar() {
  document.body.classList.remove('sidebar-open');
  var overlay = document.getElementById('sidebarOverlay');
  if (overlay) overlay.classList.add('hidden');
}

document.addEventListener('DOMContentLoaded', function() {
  var sidebarToggle = document.getElementById('sidebarToggle');
  if (sidebarToggle) {
    sidebarToggle.addEventListener('click', openSidebar);
  }
  var sidebarClose = document.getElementById('sidebarClose');
  if (sidebarClose) {
    sidebarClose.addEventListener('click', closeSidebar);
  }
  var sidebarOverlay = document.getElementById('sidebarOverlay');
  if (sidebarOverlay) {
    sidebarOverlay.addEventListener('click', closeSidebar);
  }
});
