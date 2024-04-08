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
@push('scripts')
    <script type="text/javascript">
        const selectCountry = '#country';

        // Initial
        $(document).ready(function() {
            initSelect2(selectCountry, {
                placeholder: 'Select a country'
            });

            onSelectCountryChange();
        });

        // Select2
        const initSelect2 = (selectId, config) => $(selectId).select2(config);

        const onSelectCountryChange = () => {
            $(selectCountry).on('change', function(e) {
                var data = $(selectCountry).val();
                @this.set('country', data);
            });
        };
    </script>
@endpush
