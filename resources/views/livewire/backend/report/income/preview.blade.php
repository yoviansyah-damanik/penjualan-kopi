<div>
    <div wire:loading>
        {{ __('Loading') }}...
    </div>
    <div wire:loading.remove>
        @if ($is_show)
            @if ($type == 'monthly')
                @include('preview.report.income_monthly')
            @elseif ($type == 'annual_recap')
                @include('preview.report.income_annual_recap')
            @else
                @include('preview.report.income_annual')
            @endif
        @endif
    </div>
</div>
