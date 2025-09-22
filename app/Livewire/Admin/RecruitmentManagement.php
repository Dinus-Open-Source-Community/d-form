<?php

namespace App\Livewire\Admin;

use App\Models\Recruitment;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Illuminate\Support\Facades\Storage;
use App\Jobs\SendRecruitmentStatusEmail;

class RecruitmentManagement extends Component
{
    use WithPagination;

    // =============================================================================
    // PROPERTIES
    // =============================================================================

    #[Url(as: 'search', except: '')]
    public string $search = '';

    #[Url(as: 'status', except: 'all')]
    public string $statusFilter = 'all';

    #[Url(as: 'division', except: 'all')]
    public string $divisionFilter = 'all';

    #[Url(as: 'semester', except: 'all')]
    public string $semesterFilter = 'all';

    #[Url(as: 'sort', except: 'created_at')]
    public string $sortField = 'created_at';

    #[Url(as: 'direction', except: 'desc')]
    public string $sortDirection = 'desc';

    public int $perPage = 10;
    public array $selectedIds = [];
    public bool $selectAll = false;
    
    // Modal properties
    public bool $showDetailModal = false;
    public bool $showReviewModal = false;
    public bool $showDeleteModal = false;
    public bool $showBulkActionModal = false;
    
    // Form properties
    public ?Recruitment $selectedRecruitment = null;
    public string $reviewAction = '';
    public string $reviewNote = '';
    public string $bulkAction = '';
    public string $bulkNote = '';

    // =============================================================================
    // LIFECYCLE HOOKS
    // =============================================================================

    public function mount()
    {
        // Cek hanya login, tidak ada permission
        abort_unless(auth()->check(), 403);
    }

    public function updating($property, $value)
    {
        if (in_array($property, ['search', 'statusFilter', 'divisionFilter', 'semesterFilter'])) {
            $this->resetPage();
        }
    }

    public function updatedSelectAll($value)
    {
        if ($value) {
            $this->selectedIds = $this->getFilteredRecruitments()->pluck('id')->toArray();
        } else {
            $this->selectedIds = [];
        }
    }

    public function updatedSelectedIds()
    {
        $this->selectAll = count($this->selectedIds) === $this->getFilteredRecruitments()->count();
    }

    // =============================================================================
    // COMPUTED PROPERTIES
    // =============================================================================

    public function getFilteredRecruitments()
    {
        return Recruitment::query()
            ->when($this->search, fn($q) => $q->search($this->search))
            ->when($this->statusFilter !== 'all', fn($q) => $q->byStatus($this->statusFilter))
            ->when($this->divisionFilter !== 'all', fn($q) => $q->byDivision($this->divisionFilter))
            ->when($this->semesterFilter !== 'all', fn($q) => $q->bySemester((int)$this->semesterFilter))
            ->orderBy($this->sortField, $this->sortDirection);
    }

    public function getRecruitments()
    {
        return $this->getFilteredRecruitments()
            ->with('reviewer')
            ->paginate($this->perPage);
    }

    public function getStatistics()
    {
        $query = Recruitment::query()
            ->when($this->search, fn($q) => $q->search($this->search))
            ->when($this->divisionFilter !== 'all', fn($q) => $q->byDivision($this->divisionFilter))
            ->when($this->semesterFilter !== 'all', fn($q) => $q->bySemester((int)$this->semesterFilter));

        return [
            'total' => $query->count(),
            'pending' => $query->clone()->byStatus('pending')->count(),
            'approved' => $query->clone()->byStatus('approved')->count(),
            'rejected' => $query->clone()->byStatus('rejected')->count(),
        ];
    }

    // =============================================================================
    // ACTIONS - CRUD OPERATIONS
    // =============================================================================

    public function showDetail($id)
    {
        $this->selectedRecruitment = Recruitment::with('reviewer')->findOrFail($id);
        $this->showDetailModal = true;
    }

    public function showReview($id, $action)
    {
        $this->selectedRecruitment = Recruitment::findOrFail($id);
        $this->reviewAction = $action;
        $this->reviewNote = '';
        $this->showReviewModal = true;
    }

    public function submitReview()
    {
        $this->validate([
            'reviewNote' => $this->reviewAction === 'reject' ? 'required|string|min:10' : 'nullable|string'
        ], [
            'reviewNote.required' => 'Catatan penolakan wajib diisi',
            'reviewNote.min' => 'Catatan penolakan minimal 10 karakter',
            'reviewNote.string' => 'Catatan harus berupa teks'
        ]);

        $this->selectedRecruitment->update([
            'status' => $this->reviewAction === 'approve' ? 'approved' : 'rejected',
            'catatan' => $this->reviewNote,
            'reviewed_by' => auth()->id(),
            'reviewed_at' => now(),
        ]);

        dispatch(new SendRecruitmentStatusEmail($this->selectedRecruitment));

        $this->closeReviewModal();
        $this->dispatch('recruitment-reviewed', [
            'message' => 'Data recruitment berhasil di' . ($this->reviewAction === 'approve' ? 'terima' : 'tolak')
        ]);
    }

    public function confirmDelete($id)
    {
        $this->selectedRecruitment = Recruitment::findOrFail($id);
        $this->showDeleteModal = true;
    }

    public function deleteRecruitment()
    {
        $this->selectedRecruitment->delete();
        $this->closeDeleteModal();
        $this->dispatch('recruitment-deleted', [
            'message' => 'Data recruitment berhasil dihapus'
        ]);
    }

    // =============================================================================
    // ACTIONS - BULK OPERATIONS
    // =============================================================================

    public function showBulkAction()
    {
        if (empty($this->selectedIds)) {
            $this->dispatch('alert', [
                'type' => 'warning',
                'message' => 'Pilih data yang akan diproses'
            ]);
            return;
        }

        $this->bulkAction = '';
        $this->bulkNote = '';
        $this->showBulkActionModal = true;
    }

    public function submitBulkAction()
    {
        // Validasi input dengan pesan error yang jelas
        $this->validate([
            'bulkAction' => 'required|in:approve,reject,delete',
            'bulkNote' => $this->bulkAction === 'reject' ? 'required|string|min:10' : 'nullable|string'
        ], [
            'bulkAction.required' => 'Pilih aksi yang akan dilakukan',
            'bulkAction.in' => 'Aksi yang dipilih tidak valid',
            'bulkNote.required' => 'Catatan penolakan wajib diisi',
            'bulkNote.min' => 'Catatan penolakan minimal 10 karakter',
            'bulkNote.string' => 'Catatan harus berupa teks'
        ]);

        // Ambil data recruitment yang dipilih
        $recruitments = Recruitment::whereIn('id', $this->selectedIds)->get();
        $count = $recruitments->count();

        if ($count === 0) {
            $this->dispatch('alert', [
                'type' => 'warning',
                'message' => 'Tidak ada data yang dipilih.'
            ]);
            return;
        }

        // Loop tiap recruitment dan lakukan aksi sesuai bulkAction
        foreach ($recruitments as $recruitment) {
            switch ($this->bulkAction) {
                case 'approve':
                    $recruitment->update([
                        'status' => 'approved',
                        'catatan' => $this->bulkNote,
                        'reviewed_by' => auth()->id(),
                        'reviewed_at' => now(),
                    ]);
                    dispatch(new SendRecruitmentStatusEmail($recruitment));
                    break;
                
                case 'reject':
                    $recruitment->update([
                        'status' => 'rejected',
                        'catatan' => $this->bulkNote,
                        'reviewed_by' => auth()->id(),
                        'reviewed_at' => now(),
                    ]);
                    dispatch(new SendRecruitmentStatusEmail($recruitment));
                    break;
                
                case 'delete':
                    $recruitment->delete();
                    break;
            }
        }

        // Reset selection dan modal
        $this->selectedIds = [];
        $this->selectAll = false;
        $this->closeBulkActionModal();

        // Tentukan teks aksi
        $actionText = match($this->bulkAction) {
            'approve' => 'diterima',
            'reject' => 'ditolak',
            'delete' => 'dihapus',
            default => 'diproses'
        };

        // Kirim event ke frontend
        $this->dispatch('bulk-action-completed', [
            'message' => "{$count} data recruitment berhasil {$actionText}"
        ]);
    }

    // =============================================================================
    // ACTIONS - SORTING & FILTERING
    // =============================================================================

    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortField = $field;
            $this->sortDirection = 'asc';
        }
    }

    public function clearFilters()
    {
        $this->search = '';
        $this->statusFilter = 'all';
        $this->divisionFilter = 'all'; 
        $this->semesterFilter = 'all';
        $this->sortField = 'created_at';
        $this->sortDirection = 'desc';
        $this->resetPage();
    }

    // =============================================================================
    // ACTIONS - EXPORT
    // =============================================================================

    public function export()
    {
        $this->dispatch('start-export');
        return redirect()->route('admin.recruitment.export', [
            'search' => $this->search,
            'status' => $this->statusFilter,
            'division' => $this->divisionFilter,
            'semester' => $this->semesterFilter,
        ]);
    }

    // =============================================================================
    // ACTIONS - FILE PREVIEW
    // =============================================================================

    public function previewFile($id, $type)
    {
        $recruitment = Recruitment::findOrFail($id);
        
        $filePath = match($type) {
            'cv' => $recruitment->cv,
            'instagram' => $recruitment->bukti_follow_instagram,
            'linkedin' => $recruitment->bukti_follow_linkedin,
            default => null
        };

        if (!$filePath || !Storage::exists('public/' . $filePath)) {
            $this->dispatch('alert', [
                'type' => 'error',
                'message' => 'File tidak ditemukan'
            ]);
            return;
        }

        $this->dispatch('preview-file', [
            'url' => asset('storage/' . $filePath),
            'type' => $type,
            'name' => $recruitment->nama_lengkap
        ]);
    }

    // =============================================================================
    // MODAL HELPERS
    // =============================================================================

    public function closeDetailModal()
    {
        $this->showDetailModal = false;
        $this->selectedRecruitment = null;
    }

    public function closeReviewModal()
    {
        $this->showReviewModal = false;
        $this->selectedRecruitment = null;
        $this->reviewAction = '';
        $this->reviewNote = '';
    }

    public function closeDeleteModal()
    {
        $this->showDeleteModal = false;
        $this->selectedRecruitment = null;
    }

    public function closeBulkActionModal()
    {
        $this->showBulkActionModal = false;
        $this->bulkAction = '';
        $this->bulkNote = '';
    }

    // =============================================================================
    // EVENT LISTENERS
    // =============================================================================

    #[On('recruitment-updated')]
    public function refreshComponent()
    {
        // Refresh component when data updated
    }

    // =============================================================================
    // RENDER
    // =============================================================================

    public function render()
    {
        return view('livewire.admin.recruitment-management', [
            'recruitments' => $this->getRecruitments(),
            'statistics' => $this->getStatistics(),
            'divisions' => Recruitment::getDivisions(),
            'semesters' => range(1, 8)
        ]);
    }
}