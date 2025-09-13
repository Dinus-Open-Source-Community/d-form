<div>
    <button wire:click="exportCsv" class="btn btn-success mb-2">Export CSV</button>
    <table class="table table-bordered">
        <thead>
            <tr>
                @foreach(\Schema::getColumnListing('recruitments') as $field)
                    <th>{{ $field }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @foreach($recruitments as $row)
                <tr>
                    @foreach(\Schema::getColumnListing('recruitments') as $field)
                        <td>{{ $row->$field }}</td>
                    @endforeach
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $recruitments->links() }}
</div>