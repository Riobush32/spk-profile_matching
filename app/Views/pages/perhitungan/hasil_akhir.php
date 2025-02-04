<div class=""></div>
<div
    class="page-break p-4 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700 mt-2 group hover:border-cyan-200 transition ease-in-out duration-300">
    <h1 class="print:text-black text-white group-hover:text-amber-300 transition ease-in-out duration-300 text-2xl">
        Hasil Akhir
    </h1>
    <hr
        class="h-px mb-8 mt-3 group-hover:bg-cyan-300 transition ease-in-out duration-300 bg-gray-200 border-0 dark:bg-gray-700">
    <?php foreach($hasil_akhir as $value): ?>
    <h1 class="mb-4 text-3xl font-extrabold text-gray-900 dark:text-white md:text-5xl lg:text-6xl animate-pulse"><span
            class="text-white print:text-black group-hover:text-transparent group-hover:bg-clip-text  group-hover:bg-gradient-to-r group-hover:to-emerald-600 group-hover:from-sky-400"><?=$value['alternative']?></span>
        <span class="group-hover:text-amber-300"><?=$value['score']?></span>
    </h1>

    <?php endforeach; ?>
    <div class="grid grid-cols-1 md:gap-4 gap-1 mt-8">
        <div class="">
            <div class=" w-full bg-white rounded-lg shadow dark:bg-gray-800 p-4 md:p-6">
                <div class="flex justify-between border-gray-200 border-b dark:border-gray-700 pb-3">
                    <dl>
                        <dt class="print:text-black text-base font-normal text-gray-500 dark:text-gray-400 pb-1">Nilai
                        </dt>
                        <dd class="print:text-black leading-none text-3xl font-bold text-gray-900 dark:text-white">Gap
                        </dd>
                    </dl>
                </div>

                <div class="py-3">
                    <dl>
                        <dt class="text-base font-normal text-gray-500 dark:text-gray-400 pb-1">Hasil Selisih dari Nilai
                            Alternative -
                            Nilai Standar dan disesuaikan dengan ketetapan bobot</dt>
                        <dd class="leading-none text-xl font-bold text-green-500 dark:text-green-400">Bobot</dd>
                    </dl>
                </div>

                <div id="bar-chart" class="w-full"></div>
                <div
                    class="grid grid-cols-1 items-center border-gray-200 border-t dark:border-gray-700 justify-between">
                    <div class="flex justify-between items-center pt-5">

                    </div>
                </div>
            </div>

        </div>
        <div class="page-break mt-5">
            <div class=" w-full bg-white rounded-lg shadow dark:bg-gray-800 p-4 md:p-6">
                <div class="flex justify-between border-gray-200 border-b dark:border-gray-700 pb-3">
                    <dl>
                        <dt class="text-base font-normal text-gray-500 dark:text-gray-400 pb-1">Nilai</dt>
                        <dd class="leading-none text-3xl font-bold text-gray-900 dark:text-white">Final Score</dd>
                    </dl>
                </div>

                <div class="py-3">
                    <dl>
                        <dt class="text-base font-normal text-gray-500 dark:text-gray-400 pb-1">Hasil Akhir Dari
                            Perhitungan</dt>
                        <dd class="leading-none text-xl font-bold text-green-500 dark:text-green-400">Score</dd>
                    </dl>
                </div>

                <div id="bar-chart2" class="w-full"></div>
                <div
                    class="grid grid-cols-1 items-center border-gray-200 border-t dark:border-gray-700 justify-between">
                    <div class="flex justify-between items-center pt-5">

                    </div>
                </div>
            </div>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

    <script>
    // Ambil data dari PHP ke JavaScript
    const chartData = <?= json_encode($nilai_gap); ?>; // Data nilai gap per alternatif
    const criteria = <?= json_encode($kriterias); ?>; // Data nama kriteria
    const finalScore = <?= json_encode($final_score); ?>; // Data final

    // Buat kategori untuk chart (nama alternatif)
    const categoryData = chartData.map(row => row.alternative);

    // Buat data untuk setiap kriteria berdasarkan nilai GAP
    const seriesData = criteria.map((cri, index) => ({
        name: cri.nama_kriteria, // Nama kriteria
        data: chartData.map(row => row.gap[index]?.nilai || 0), // Nilai gap untuk setiap alternatif
        color: `#${Math.floor(Math.random() * 16777215).toString(16)}`, // Warna acak
    }));

    const finalData = [{
        name: "Final Score",
        data: finalScore.map(row => row.score || 0),
        color: `#${Math.floor(Math.random() * 16777215).toString(16)}`,
    }];


    const options = {
        series: seriesData,
        chart: {
            sparkline: {
                enabled: false,
            },
            type: "bar",
            width: "100%",
            height: "100%",
            toolbar: {
                show: false,
            }
        },
        fill: {
            opacity: 1,
        },
        plotOptions: {
            bar: {
                horizontal: false,
                columnWidth: "90%",
                borderRadiusApplication: "end",
                borderRadius: 6,
                dataLabels: {
                    position: "top",
                },
            },
        },
        legend: {
            show: true,
            position: "bottom",
        },
        dataLabels: {
            enabled: false,
        },
        tooltip: {
            shared: true,
            intersect: false,
            formatter: function(value) {
                return "" + value
            }
        },
        xaxis: {
            labels: {
                show: true,
                style: {
                    fontFamily: "Inter, sans-serif",
                    cssClass: 'text-xs font-normal fill-gray-500 dark:fill-gray-400'
                },
                formatter: function(value) {
                    return "" + value
                }
            },
            categories: categoryData,
            axisTicks: {
                show: true,
            },
            axisBorder: {
                show: true,
            },
        },
        yaxis: {
            labels: {
                show: true,
                style: {
                    fontFamily: "Inter, sans-serif",
                    cssClass: 'text-xs font-normal fill-gray-500 dark:fill-gray-400'
                }
            }
        },
        grid: {
            show: true,
            strokeDashArray: 4,
            padding: {
                left: 2,
                right: 2,
                top: -20
            },
        },
        fill: {
            opacity: 0.9,
        }
    }
    const options2 = {
        series: finalData,
        chart: {
            sparkline: {
                enabled: false,
            },
            type: "bar",
            width: "100%",
            height: "100%",
            toolbar: {
                show: false,
            }
        },
        fill: {
            opacity: 1,
        },
        plotOptions: {
            bar: {
                horizontal: false,
                columnWidth: "50%",
                borderRadiusApplication: "end",
                borderRadius: 6,
                dataLabels: {
                    position: "top",
                },
            },
        },
        legend: {
            show: true,
            position: "bottom",
        },
        dataLabels: {
            enabled: false,
        },
        tooltip: {
            shared: true,
            intersect: false,
            formatter: function(value) {
                return "" + value
            }
        },
        xaxis: {
            labels: {
                show: true,
                style: {
                    fontFamily: "Inter, sans-serif",
                    cssClass: 'text-xs font-normal fill-gray-500 dark:fill-gray-400'
                },
                formatter: function(value) {
                    return "" + value
                }
            },
            categories: categoryData,
            axisTicks: {
                show: false,
            },
            axisBorder: {
                show: false,
            },
        },
        yaxis: {
            labels: {
                show: true,
                style: {
                    fontFamily: "Inter, sans-serif",
                    cssClass: 'text-xs font-normal fill-gray-500 dark:fill-gray-400'
                }
            }
        },
        grid: {
            show: true,
            strokeDashArray: 4,
            padding: {
                left: 2,
                right: 2,
                top: -20
            },
        },
        fill: {
            opacity: 0.85,
        }
    }

    if (document.getElementById("bar-chart") && typeof ApexCharts !== 'undefined') {
        const chart = new ApexCharts(document.getElementById("bar-chart"), options);
        chart.render();
    }
    if (document.getElementById("bar-chart2") && typeof ApexCharts !== 'undefined') {
        const chart = new ApexCharts(document.getElementById("bar-chart2"), options2);
        chart.render();
    }
    </script>

</div>