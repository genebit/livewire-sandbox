<div class="d-flex flex-column gap-3 position-relative">
    <div wire:loading wire:target="increment, decrement">
        <div class="position-absolute top-50 start-50 translate-middle d-flex flex-column justify-content-center"
            style="z-index: 1000">
            <div class="text-center">
                <div class="spinner-border text-primary" role="status"></div>
            </div>
            <span class="text-center">Loading...</span>
        </div>
    </div>
    <section class="d-flex flex-column gap-3">
        <h3 class="text-center fw-bolder">Counter</h3>
        <span class="h1 text-center">{{ $count }}</span>
        <div class="d-flex mx-auto gap-2">
            <button wire:click="increment" class="btn btn-primary px-5" style="width: max-content">Add</button>
            <button wire:click="decrement" class="btn btn-danger px-5" style="width: max-content">Subtract</button>
        </div>
        <div wire:ignore class="mx-auto" style="width: max-content">
            <select name="country" id="country" style="width: 20rem">
                <option value=""></option>
                @foreach ($countries as $country)
                    <option value="{{ ((object) $country)->code }}">{{ ((object) $country)->name }}</option>
                @endforeach
            </select>
        </div>
    </section>
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
        const selectCountry = '#country';

        // Initial
        $(document).ready(function() {
            initDataTable(tableId);
            initSelect2(selectCountry, {
                placeholder: 'Select a country'
            });

            onSelectCountryChange();
        });

        // Handles the event fired from the component
        Livewire.on('reload', () => {
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

        // Select2
        const initSelect2 = (selectId, config) => $(selectId).select2(config);

        const onSelectCountryChange = () => {
            $(selectCountry).on('change', function(e) {
                var data = $(selectCountry).val();
                @this.set('country', data);
            });
        };

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
