// Open Pop Up
function openModal(modalId) {
    var modal = document.getElementById(modalId);
    if (modal) {
        modal.style.display = "block";
    }
}

// Close Pop Up
function closeModal(modalId) {
    var modal = document.getElementById(modalId);
    if (modal) {
        modal.style.display = "none";
    }
}
// Reset filters
function resetFilters() {
    document.getElementById('alphabet').selectedIndex = 0;
    document.getElementById('gender').selectedIndex = 0;
    document.getElementById('role').selectedIndex = 0;
    document.getElementById('birthdate_start').value = '';
    document.getElementById('birthdate_end').value = '';
    document.getElementById('username_search').value = '';
    window.location.href = window.location.pathname;
}