<div
    class="p-4 bg-white border border-gray-200 rounded-lg shadow-sm xl:col-span-2 dark:border-gray-700 sm:p-6 dark:bg-gray-800">
    <div class="flex items-center justify-between mb-4">
        <div class="flex-shrink-0">
            <h2 class="text-2xl font-bold dark:text-white">
                {{ __('Sales Chart') }}
            </h2>
        </div>
        <div class="text-base font-medium">
            <div class="text-xl font-bold leading-none text-gray-900 sm:text-2xl text-end dark:text-white">
                {{ StringHelper::currency($total_transaction, true) }}
            </div>
            <h3 class="text-base font-light text-gray-500 dark:text-gray-400">
                @if ($type == 'annual')
                    {{ __('Sales in :year', ['year' => $year]) }}
                @else
                    {{ __('Sales in :month :year', ['month' => Carbon::createFromFormat('m', $month)->translatedFormat('F'), 'year' => $year]) }}
                @endif
            </h3>
        </div>
    </div>
    <div wire:ignore>
        <div id="main-chart" style="min-height: 435px;"></div>
    </div>
    <div class="flex items-center justify-end pt-3 mt-4 border-t border-gray-200 sm:pt-6 dark:border-gray-700">
        <div class="flex-shrink-0">
            <a href="{{ route('dashboard.report.sales') }}"
                class="inline-flex items-center p-2 text-xs font-medium uppercase rounded-lg text-primary-700 sm:text-sm hover:bg-gray-100 dark:text-primary-500 dark:hover:bg-gray-700">
                {{ __('Sales Report') }}
                <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7">
                    </path>
                </svg>
            </a>
        </div>
    </div>
</div>

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script type="text/javascript">
        const getMainChartColors = () => {
            let mainChartColors = {}

            if (document.documentElement.classList.contains('dark')) {
                mainChartColors = {
                    borderColor: '#374151',
                    labelColor: '#9CA3AF',
                    opacityFrom: 0,
                    opacityTo: 0.15,
                };
            } else {
                mainChartColors = {
                    borderColor: '#F3F4F6',
                    labelColor: '#6B7280',
                    opacityFrom: 0.45,
                    opacityTo: 0,
                }
            }

            return mainChartColors;
        }

        const getOptions = (type, categories, month, year) => {
            let mainChartColors = getMainChartColors()

            options = {
                markers: {
                    size: 5,
                    strokeColors: '#ffffff',
                    hover: {
                        size: undefined,
                        sizeOffset: 3
                    }
                },
                xaxis: {
                    categories: categories,
                    labels: {
                        style: {
                            colors: [mainChartColors.labelColor],
                            fontSize: '14px',
                            fontWeight: 500,
                        },
                    },
                    axisBorder: {
                        color: mainChartColors.borderColor,
                    },
                    axisTicks: {
                        color: mainChartColors.borderColor,
                    },
                    crosshairs: {
                        show: true,
                        position: 'back',
                        stroke: {
                            color: mainChartColors.borderColor,
                            width: 1,
                            dashArray: 10,
                        },
                    },
                },
                yaxis: {
                    labels: {
                        style: {
                            colors: [mainChartColors.labelColor],
                            fontSize: '14px',
                            fontWeight: 500,
                        },
                        formatter: function(value) {
                            return new Intl.NumberFormat('id-ID', {
                                maximumSignificantDigits: 3
                            }).format(
                                value,
                            );
                        }
                    },
                },
                legend: {
                    fontSize: '14px',
                    fontWeight: 500,
                    fontFamily: 'Inter, sans-serif',
                    labels: {
                        colors: [mainChartColors.labelColor]
                    },
                    itemMargin: {
                        horizontal: 10
                    }
                },
                responsive: [{
                    breakpoint: 1024,
                    options: {
                        xaxis: {
                            labels: {
                                show: false
                            }
                        }
                    }
                }],
                chart: {
                    id: 'main-chart',
                    height: 420,
                    type: 'area',
                    foreColor: mainChartColors.labelColor,
                    toolbar: {
                        show: false
                    },
                    stacked: true
                },
                stroke: {
                    curve: 'smooth',
                },
                fill: {
                    type: 'gradient',
                    gradient: {
                        enabled: true,
                        opacityFrom: mainChartColors.opacityFrom,
                        opacityTo: mainChartColors.opacityTo
                    }
                },
                dataLabels: {
                    enabled: false
                },
                grid: {
                    show: true,
                    borderColor: mainChartColors.borderColor,
                    strokeDashArray: 1,
                    padding: {
                        left: 35,
                        bottom: 15
                    }
                },
                tooltip: {
                    style: {
                        fontSize: '14px',
                        fontFamily: 'Inter, sans-serif',
                    },
                    x: {
                        formatter: function(value) {
                            if (type != 'annual')
                                return value + ' ' + month + ' ' + year

                            return value
                        }
                    },
                    y: {
                        formatter: function(value) {
                            if (!value)
                                return "Tidak ada"

                            return new Intl.NumberFormat('id-ID', {
                                maximumSignificantDigits: 3
                            }).format(
                                value,
                            )
                        }
                    }
                },
            };

            return options;
        }

        let chart = new ApexCharts(document.getElementById('main-chart'), {
            series: [{
                name: 'Dummy Data',
                data: [1, 2]
            }],
            ...getOptions([1, 2])
        });

        document.addEventListener('setData', (data) => {
            var type = data.detail[0]['type']
            var categories = data.detail[0]['categories']
            var series = data.detail[0]['series']
            var month = data.detail[0]['month']
            var year = data.detail[0]['year']

            chart.updateOptions(getOptions(type, categories, month, year))
            chart.updateSeries(series)
        })

        document.addEventListener('livewire:init', () => {
            chart.render();
        })
    </script>
@endpush
