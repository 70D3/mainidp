{{-- ================================= RADAR CHART KOMPETENSI PARTIAL ================================= --}}
@php
    $radarLabels = $competencies->pluck('name')->toArray();
    $radarDatasets = [];
    $radarColors = [
        ['border' => '#14b8a6', 'bg' => 'rgba(20,184,166,0.15)'],
        ['border' => '#6366f1', 'bg' => 'rgba(99,102,241,0.15)'],
        ['border' => '#f59e0b', 'bg' => 'rgba(245,158,11,0.15)'],
        ['border' => '#ef4444', 'bg' => 'rgba(239,68,68,0.15)'],
        ['border' => '#8b5cf6', 'bg' => 'rgba(139,92,246,0.15)'],
    ];

    // Standard/Target dataset
    $standardValues = [];
    foreach ($competencies as $comp) {
        $standardValues[] = (float) ($standards[$comp->id] ?? 0);
    }
    $radarDatasets[] = [
        'label' => 'Target Standar',
        'data' => $standardValues,
        'borderColor' => '#1e293b',
        'backgroundColor' => 'rgba(30,41,59,0.08)',
        'borderWidth' => 2,
        'borderDash' => [6, 3],
        'pointBackgroundColor' => '#1e293b',
        'pointRadius' => 4,
    ];

    // Talents dataset
    $talentList = is_iterable($talents) ? $talents : (isset($talent) ? [$talent] : []);
    foreach ($talentList as $tIdx => $tItem) {
        $talentScores = [];
        foreach ($competencies as $comp) {
            $d = isset($tItem->assessmentSession) && $tItem->assessmentSession
                ? $tItem->assessmentSession->details->firstWhere('competence_id', $comp->id)
                : null;
            $sT = (float) ($d->score_talent ?? 0);
            $sA = (float) ($d->score_atasan ?? 0);
            if ($sT > 0 && $sA > 0) {
                $talentScores[] = round(($sT + $sA) / 2, 2);
            } elseif ($sT > 0) {
                $talentScores[] = $sT;
            } else {
                $talentScores[] = 0;
            }
        }
        $colorIdx = $tIdx % count($radarColors);
        $radarDatasets[] = [
            'label' => $tItem->nama ?? 'Talent',
            'data' => $talentScores,
            'borderColor' => $radarColors[$colorIdx]['border'],
            'backgroundColor' => $radarColors[$colorIdx]['bg'],
            'borderWidth' => 2,
            'borderDash' => [],
            'pointBackgroundColor' => $radarColors[$colorIdx]['border'],
            'pointRadius' => 5,
            'pointHoverRadius' => 7,
        ];
    }

    $uniqueChartId = 'radarChart_' . uniqid();
    $uniqueWrapId = 'radarWrap_' . uniqid();
@endphp

<div class="sub-section-title" style="margin-top: 32px;">
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
        <path fill-rule="evenodd"
            d="M2.25 4.5A.75.75 0 0 1 3 3.75h18a.75.75 0 0 1 .75.75v10.5a.75.75 0 0 1-.75.75h-8.25v2.25H16.5a.75.75 0 0 1 0 1.5h-9a.75.75 0 0 1 0-1.5h3.75V15.75H3a.75.75 0 0 1-.75-.75V4.5Zm3 2.25a.75.75 0 0 0 0 1.5h.008a.75.75 0 0 0 0-1.5H5.25Zm.008 3a.75.75 0 0 0 0 1.5h.008a.75.75 0 0 0 0-1.5H5.258Zm4.492-2.31a.75.75 0 0 0-1.06 1.06l1.72 1.72a.75.75 0 0 0 1.06 0l1.72-1.72 2.47 2.47a.75.75 0 1 0 1.06-1.06l-3-3a.75.75 0 0 0-1.06 0l-1.72 1.72-1.19-1.19Z"
            clip-rule="evenodd" />
    </svg>
    Radar Chart Skor Kompetensi
</div>

<style>
    .radar-kompetensi-card {
        background: #fff;
        border-radius: 20px;
        border: 1px solid #dbe4ee;
        box-shadow: 0 8px 28px rgba(15,23,42,0.07);
        padding: 16px 20px 12px;
        margin-bottom: 16px;
        overflow: visible;
    }
    .radar-chart-canvas-box {
        position: relative;
        width: 100%;
        max-width: 970px;
        margin: 0 auto;
        overflow: visible;
    }
    .radar-chart-canvas-box canvas {
        display: block;
        width: 100% !important;
        overflow: visible;
    }
    .radar-legend-container {
        display: flex;
        flex-wrap: wrap;
        gap: 10px 24px;
        justify-content: center;
        margin-bottom: 10px;
    }
    .radar-legend-item-box {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 0.8rem;
        font-weight: 600;
        color: #374151;
    }
    .radar-scale-info-text {
        text-align: center;
        margin-top: 8px;
        font-size: 0.75rem;
        color: #94a3b8;
        font-style: italic;
    }
    @media (max-width: 767px) {
        .radar-kompetensi-card {
            padding: 16px 8px 14px;
            border-radius: 14px;
        }
        .radar-chart-canvas-box {
            max-width: 100%;
        }
        .radar-legend-container {
            gap: 8px 14px;
            margin-bottom: 14px;
        }
        .radar-legend-item-box {
            font-size: 0.72rem;
        }
        .radar-scale-info-text {
            font-size: 0.68rem;
            margin-top: 10px;
        }
    }
</style>

<div class="radar-kompetensi-card" id="{{ $uniqueWrapId }}">
    {{-- Custom Legend --}}
    <div class="radar-legend-container">
        <div class="radar-legend-item-box" style="color: #1e293b;">
            <svg width="28" height="10" viewBox="0 0 28 10" style="flex-shrink:0">
                <line x1="0" y1="5" x2="28" y2="5" stroke="#1e293b" stroke-width="2" stroke-dasharray="6,3"/>
            </svg>
            Target Standar
        </div>
        @foreach ($talentList as $tIdx => $tItem)
            @php
                $colorIdx = $tIdx % 5;
                $borderColors = ['#14b8a6','#6366f1','#f59e0b','#ef4444','#8b5cf6'];
                $c = $borderColors[$colorIdx];
            @endphp
            <div class="radar-legend-item-box">
                <span style="width:13px;height:13px;border-radius:50%;background:{{ $c }};flex-shrink:0;display:inline-block;"></span>
                {{ $tItem->nama ?? 'Talent' }}
            </div>
        @endforeach
    </div>

    {{-- Chart Canvas --}}
    <div class="radar-chart-canvas-box">
        <canvas id="{{ $uniqueChartId }}"></canvas>
    </div>

    {{-- Info --}}
    <div class="radar-scale-info-text">
        Skala: 0 &ndash; 5 &nbsp;|&nbsp; Skor = Rata-rata (Level Talent + Level Atasan)
    </div>
</div>

<script>
    (function () {
        var isMobile = function () { return window.innerWidth < 640; };
        var isTablet = function () { return window.innerWidth < 1024; };

        function wrapLabel(str, maxChars) {
            if (!str || str.length <= maxChars) return str;
            var idx = str.lastIndexOf(' ', maxChars);
            if (idx < 1) idx = maxChars;
            return [str.slice(0, idx).trim(), str.slice(idx).trim()];
        }

        var chartId = @json($uniqueChartId);

        function initThisRadarChart() {
            var canvasEl = document.getElementById(chartId);
            if (!canvasEl) return;

            var mobile = isMobile();
            var tablet = isTablet();

            var lblSize  = mobile ? 10  : (tablet ? 12 : 14);
            var lblPad   = mobile ? 4   : (tablet ? 14 : 24);
            var tickSize = mobile ? 9   : (tablet ? 10 : 12);
            var ptRadius = mobile ? 4   : (tablet ? 5  : 7);
            var ptHover  = mobile ? 6   : (tablet ? 7  : 10);
            var bdWidth  = mobile ? 1.5 : (tablet ? 2  : 2.5);
            var maxWrap  = mobile ? 17  : (tablet ? 17 : 20);

            var padV = 0;
            var padH = mobile ? 6   : (tablet ? 40 : 75);

            var rawLabels   = @json($radarLabels);
            var rawDatasets = @json($radarDatasets);

            var labels = rawLabels.map(function (l) {
                if (mobile) {
                    if (l.toLowerCase().includes('problem solving') || l.toLowerCase().includes('decision') || l.toLowerCase().includes('decission')) {
                        return ['Problem', 'Solving & ...'];
                    }
                }
                return wrapLabel(l, maxWrap);
            });

            var datasets = rawDatasets.map(function (ds, i) {
                return {
                    label:               ds.label,
                    data:                ds.data,
                    borderColor:         ds.borderColor,
                    backgroundColor:     ds.backgroundColor,
                    borderWidth:         i === 0 ? (mobile ? 1.5 : 2) : bdWidth,
                    borderDash:          ds.borderDash || [],
                    pointBackgroundColor: ds.pointBackgroundColor,
                    pointRadius:         i === 0 ? (mobile ? 2.5 : 4) : ptRadius,
                    pointHoverRadius:    i === 0 ? (mobile ? 4.5 : 5) : ptHover,
                    fill: true,
                };
            });

            if (window['_inst_' + chartId]) {
                try { window['_inst_' + chartId].destroy(); } catch (e) {}
            }

            window['_inst_' + chartId] = new Chart(canvasEl, {
                type: 'radar',
                data: { labels: labels, datasets: datasets },
                options: {
                    responsive: true,
                    maintainAspectRatio: true,
                    aspectRatio: mobile ? 1.05 : (tablet ? 1.4 : 1.7),
                    layout: {
                        padding: {
                            top:    mobile ? 16 : 38,
                            bottom: 0,
                            left:   padH,
                            right:  padH,
                        }
                    },
                    scales: {
                        r: {
                            min: 0,
                            max: 5,
                            ticks: {
                                stepSize: 1,
                                font: { size: tickSize, family: "'Inter', sans-serif" },
                                color: '#94a3b8',
                                backdropColor: 'transparent',
                                display: !mobile,
                            },
                            grid:       { color: 'rgba(203,213,225,0.6)' },
                            angleLines: { color: 'rgba(203,213,225,0.5)' },
                            pointLabels: {
                                font: { size: lblSize, weight: '700', family: "'Inter', sans-serif" },
                                color: '#1e293b',
                                padding: lblPad,
                            },
                        },
                    },
                    plugins: {
                        legend: { display: false },
                        tooltip: {
                            backgroundColor: 'rgba(15,23,42,0.9)',
                            titleFont: { size: mobile ? 12 : 14, weight: '700', family: "'Inter', sans-serif" },
                            bodyFont:  { size: mobile ? 11 : 13, family: "'Inter', sans-serif" },
                            padding: mobile ? 10 : 14,
                            cornerRadius: 10,
                            callbacks: {
                                label: function (ctx) {
                                    return '  ' + ctx.dataset.label + ': ' + ctx.raw;
                                }
                            }
                        }
                    },
                    animation: { duration: 700, easing: 'easeInOutQuart' },
                },
            });
        }

        function loadAndInit() {
            if (typeof Chart !== 'undefined') {
                initThisRadarChart();
            } else {
                var s = document.createElement('script');
                s.src = 'https://cdn.jsdelivr.net/npm/chart.js@4.4.4/dist/chart.umd.min.js';
                s.onload = initThisRadarChart;
                document.head.appendChild(s);
            }
        }

        loadAndInit();

        var _rt;
        window.addEventListener('resize', function () {
            clearTimeout(_rt);
            _rt = setTimeout(function () {
                if (typeof Chart !== 'undefined') initThisRadarChart();
            }, 200);
        });

        if (window.MutationObserver) {
            var mob = new MutationObserver(function () {
                if (document.getElementById(chartId)) {
                    setTimeout(function () {
                        if (typeof Chart !== 'undefined') initThisRadarChart();
                    }, 50);
                }
            });
            mob.observe(document.body, { childList: true, subtree: true });
        }
    })();
</script>
