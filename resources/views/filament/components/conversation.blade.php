<div x-load-css="[@js(\Filament\Support\Facades\FilamentAsset::getStyleHref('agora'))]">
    <?php
    $now = Carbon\Carbon::now();
    $start = Carbon\Carbon::parse($record->date);
    $end = Carbon\Carbon::parse($record->date)->addMinutes($record->duration);
    ?>
    @if ($now->between($start, $end) && $record->payment_status->value == 'paid')
        @if (!$sessionRunning)
            <x-filament::button wire:click="startSession" class="mb-2">
                @lang('forms.actions.start_session')

            </x-filament::button>
        @endif
    @endif

    <div id="agora-react"></div>


</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        console.log("{{ $record->id }}")
        window.order_id = "{{ $record->id }}";
    });
</script>
