document.addEventListener('DOMContentLoaded', function() {
    const tableContainer = document.getElementById('user-table-container');
    const searchForm = document.getElementById('search-form');
    const searchInput = document.getElementById('search-input');
    const roleFilter = document.getElementById('role-filter');
    const resetFilter = document.getElementById('reset-filter');
    const loadingIndicator = document.getElementById('loading-indicator');
    
    let typingTimer;
    const doneTypingInterval = 500; // ms
    
    // Function to load users with AJAX
    function loadUsers(url) {
        showLoading();
        
        fetch(url, {
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(response => {
            if (!response.ok) {
                throw new Error(`HTTP error! Status: ${response.status}`);
            }
            return response.text();
        })
        .then(html => {
            hideLoading();
            tableContainer.innerHTML = html;
            
            // Re-init event handlers
            initTooltips();
            initDeleteButtons();
            initEmptyResetButton();
            
            // Update browser URL without page refresh
            try {
                window.history.pushState({}, '', url);
            } catch (e) {
                console.warn('Could not update URL:', e);
            }
        })
        .catch(error => {
            hideLoading();
            console.error('Error loading users:', error);
        });
    }
    
    // Show loading indicator
    function showLoading() {
        loadingIndicator.classList.remove('d-none');
        tableContainer.classList.add('opacity-50');
    }
    
    // Hide loading indicator
    function hideLoading() {
        loadingIndicator.classList.add('d-none');
        tableContainer.classList.remove('opacity-50');
    }
    
    // Initialize tooltips
    function initTooltips() {
        const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]');
        if (tooltipTriggerList.length > 0 && typeof bootstrap !== 'undefined') {
            tooltipTriggerList.forEach(el => {
                try {
                    new bootstrap.Tooltip(el);
                } catch (e) {
                    console.warn('Error initializing tooltip:', e);
                }
            });
        }
    }
    
    // Initialize delete confirmation
    function initDeleteButtons() {
        document.querySelectorAll('.btn-delete').forEach(button => {
            // Remove existing listeners first to prevent duplicates
            button.replaceWith(button.cloneNode(true));
        });
        
        // Add fresh listeners
        document.querySelectorAll('.btn-delete').forEach(button => {
            button.addEventListener('click', function() {
                if (typeof Swal !== 'undefined') {
                    Swal.fire({
                        title: 'Yakin ingin menghapus user ini?',
                        text: "Tindakan ini tidak bisa dibatalkan!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#3085d6',
                        confirmButtonText: 'Ya, hapus',
                        cancelButtonText: 'Batal'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            const form = this.closest('form');
                            if (form) form.submit();
                        }
                    });
                } else {
                    if (confirm('Yakin ingin menghapus user ini?')) {
                        const form = this.closest('form');
                        if (form) form.submit();
                    }
                }
            });
        });
    }
    
    // Initialize empty state reset button
    function initEmptyResetButton() {
        const emptyResetBtn = document.getElementById('empty-reset-filter');
        if (emptyResetBtn) {
            emptyResetBtn.addEventListener('click', function() {
                searchInput.value = '';
                roleFilter.value = '';
                updateUsersList();
            });
        }
    }
    
    // Get query parameters as object
    function getQueryParams() {
        const params = new URLSearchParams();
        
        const searchValue = searchInput.value.trim();
        if (searchValue) {
            params.append('search', searchValue);
        }
        
        const roleValue = roleFilter.value;
        if (roleValue) {
            params.append('role', roleValue);
        }
        
        return params;
    }
    
    // Update users list based on current filters
    function updateUsersList() {
        const params = getQueryParams();
        const baseUrl = searchForm.getAttribute('action') || window.location.pathname;
        const url = `${baseUrl}?${params.toString()}`;
        loadUsers(url);
    }
    
    // Make updateUsersList available globally
    window.updateUsersList = updateUsersList;
    
    // Handle pagination links
    function handlePaginationClick(e) {
        const target = e.target.closest('.page-link');
        if (target && !target.parentElement.classList.contains('disabled')) {
            e.preventDefault();
            const href = target.getAttribute('href');
            if (href) loadUsers(href);
        }
    }
    
    // Event listeners
    searchInput.addEventListener('keyup', function() {
        clearTimeout(typingTimer);
        typingTimer = setTimeout(updateUsersList, doneTypingInterval);
    });
    
    searchInput.addEventListener('keydown', function() {
        clearTimeout(typingTimer);
    });
    
    roleFilter.addEventListener('change', updateUsersList);
    
    resetFilter.addEventListener('click', function() {
        searchInput.value = '';
        roleFilter.value = '';
        updateUsersList();
    });
    
    // Delegate event listener for pagination links
    document.addEventListener('click', function(e) {
        handlePaginationClick(e);
    });
    
    // Initialize tooltips, delete buttons, and empty reset button
    initTooltips();
    initDeleteButtons();
    initEmptyResetButton();
});