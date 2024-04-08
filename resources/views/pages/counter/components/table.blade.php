<div>
    <div wire:loading>
        <div class="position-absolute top-50 start-50 translate-middle d-flex flex-column justify-content-center"
            style="z-index: 1000">
            <div class="text-center">
                <div class="spinner-border text-primary" role="status"></div>
            </div>
            <span class="text-center">Loading...</span>
        </div>
    </div>
    <section wire:ignore>
        <h1 class="fw-bolder">Count Logs</h1>
        <table id="counterRecordsTbl" class="table table-responsive table-striped">
            <thead>
                <tr>
                    <th>Counter</th>
                    <th>Location Created</th>
                    <th>Created At</th>
                </tr>
            </thead>
            <tbody>
                @if ($counterLogs)
                    @foreach ($counterLogs as $record)
                        <tr>
                            <td>{{ ((object) $record)->count }}</td>
                            <td>{{ ((object) $record)->country }}</td>
                            <td>{{ ((object) $record)->created_at }}</td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    </section>
</div>
@push('scripts')
    <script type="text/javascript">
        const tableId = '#counterRecordsTbl';

        // Initial
        $(document).ready(function() {
            initDataTable(tableId);
        });

        // Handles the event fired from the component
        Livewire.on('logStored', (res) => {
            refreshDataTable(tableId, () => {
                // Clear the table body
                $(tableId).find('tbody').empty();

                // Iterate over the counterLogs array and append rows to the table body
                @this.counterLogs.forEach(record => {
                    $(tableId).find('tbody').append(`
                        <tr>
                            <td>${record.count}</td>
                            <td>${record.country}</td>
                            <td>${record.created_at}</td>
                        </tr>
                    `);
                });
            });
        });

        // Datatables
        const initDataTable = (tableId) => $(tableId).DataTable();
        const destroyDataTable = (tableId) => $(tableId).DataTable().destroy();

        const refreshDataTable = (tableId, action) => {
            // Refresh the DataTable instance
            destroyDataTable(tableId);
            action();
            initDataTable(tableId);
        };
    </script>
@endpush
