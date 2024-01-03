<div>
    <div wire:loading>
        {{ __('Loading') }}...
    </div>
    <div wire:loading.remove>
        @if ($is_show)
            @if ($type == 'daily')
                @include('preview.report.sales_daily')
            @elseif ($type == 'monthly')
                @include('preview.report.sales_monthly')
            @else
                @include('preview.report.sales_annual')
            @endif
        @endif
    </div>
</div>
