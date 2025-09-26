// resources/js/recruitment.js
document.addEventListener('DOMContentLoaded', function() {
    // Global Alpine.js data untuk recruitment management
    window.recruitmentData = {
        // File preview handler
        previewFile(url, type, name) {
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

    // Livewire init
    document.addEventListener('livewire:init', function() {
        // Handle export loading state
        Livewire.on('start-export', function() {
            const exportBtn = document.querySelector('[wire\\:click="export"]');
            if (exportBtn) {
                exportBtn.classList.add('opacity-50', 'cursor-not-allowed');
                exportBtn.innerHTML = '<span class="material-icons animate-spin text-sm">refresh</span>';
                
                setTimeout(() => {
                    exportBtn.classList.remove('opacity-50', 'cursor-not-allowed');
                    exportBtn.innerHTML = '<span class="material-icons text-sm">download</span>';
                }, 3000);
            }
        });

        // Handle trigger download dari Livewire
        Livewire.on('trigger-download', function(data) {
            const link = document.createElement('a');
            link.href = data[0].url;
            link.style.display = 'none';
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);
        });
    });

    // Global function untuk status export
    window.showExportStatus = function(type, count) {
        const messages = {
            'approved': `Mengexport ${count} data yang diterima...`,
            'rejected': `Mengexport ${count} data yang ditolak...`,
            'pending': `Mengexport ${count} data menunggu review...`,
            'all': `Mengexport semua ${count} data...`
        };

        const toast = document.createElement('div');
        toast.className = 'fixed top-4 right-4 bg-green-500 text-white px-4 py-2 rounded shadow-lg z-50 transition-opacity duration-300';
        toast.textContent = messages[type] || `Mengexport ${count} data...`;
        
        document.body.appendChild(toast);
        
        setTimeout(() => {
            toast.classList.add('opacity-0');
            setTimeout(() => {
                if (document.body.contains(toast)) {
                    document.body.removeChild(toast);
                }
            }, 300);
        }, 3000);
    };
});
