// resources/js/recruitment.js
document.addEventListener('DOMContentLoaded', function() {
    // Global Alpine.js data for recruitment management
    window.recruitmentData = {
        // File preview handler
        previewFile(url, type, name) {
            // Dispatch event to show preview modal
            window.dispatchEvent(new CustomEvent('preview-file', {
                detail: { url, type, name }
            }));
        },
        
        // Bulk selection helpers
        toggleAll(checked, itemIds) {
            const checkboxes = document.querySelectorAll('input[name="selectedIds"]');
            checkboxes.forEach(checkbox => {
                checkbox.checked = checked;
            });
        },
        
        // Toast notification
        showToast(message, type = 'success') {
            window.dispatchEvent(new CustomEvent('alert', {
                detail: { message, type }
            }));
        }
    };
    
    // Handle export loading state
    document.addEventListener('livewire:init', function() {
        Livewire.on('start-export', function() {
            // Show loading indicator
            const exportBtn = document.querySelector('[wire\\:click="export"]');
            if (exportBtn) {
                exportBtn.classList.add('opacity-50', 'cursor-not-allowed');
                exportBtn.innerHTML = '<span class="material-icons animate-spin text-sm">refresh</span>';
                
                // Reset after 3 seconds
                setTimeout(() => {
                    exportBtn.classList.remove('opacity-50', 'cursor-not-allowed');
                    exportBtn.innerHTML = '<span class="material-icons text-sm">download</span>';
                }, 3000);
            }
        });
    });
})
