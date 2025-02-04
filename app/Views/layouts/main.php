<!doctype html>
<html class="dark:bg-slate-900">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="<?= base_url('assets/css/output.css') ?>" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@9.0.3"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

<body class="print:bg-white">
    <style>
    table th {
        white-space: normal !important;
        word-wrap: break-word;
        text-align: start;
        vertical-align: middle;
    }

    table td {
        color: white;
    }

    @media print {


        .page-break {
            break-inside: avoid;
            /* Membuat elemen ini mulai di halaman baru */
        }

        @page {
            size: landscape;
        }

        table td {
            color: black;
        }
    }
    </style>

    <?= $this->include('/components/navbar.php'); ?>

    <aside id="logo-sidebar"
        class="print:hidden fixed top-0 left-0 z-40 w-64 h-screen pt-20 transition-transform -translate-x-full bg-white border-r border-gray-200 sm:translate-x-0 dark:bg-gray-800 dark:border-gray-700"
        aria-label="Sidebar">
        <div class="h-full px-3 pb-4 overflow-y-auto bg-white dark:bg-gray-800">
            <ul class="space-y-2 font-medium">
                <li>
                    <a href="<?= base_url('/'); ?>"
                        class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white <?= $active == 'Dashboard' ? 'dark:bg-gray-700 bg-gray-100': '' ?> hover:bg-gray-100 dark:hover:bg-gray-700 group">
                        <div
                            class="text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white  w-5">
                            <i class="fa-solid fa-chart-pie flex-shrink-0 w-5 h-5 "></i>
                        </div>

                        <span class="ms-3">Dashboard</span>
                    </a>
                </li>

                <li>
                    <button type="button"
                        class="<?= $active == 'Kriteria' || $active == 'SubKriteria' ? 'dark:bg-gray-700 bg-gray-100': '' ?> flex items-center w-full p-2 text-base text-gray-900 transition duration-75 rounded-lg group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700"
                        aria-controls="dropdown-example" data-collapse-toggle="dropdown-example">
                        <i class="fa-solid fa-border-all  w-5 h-5 "></i>
                        <span class="flex-1 ms-3 text-left rtl:text-right whitespace-nowrap">Kriteria</span>
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 4 4 4-4" />
                        </svg>
                    </button>
                    <ul id="dropdown-example" class="hidden py-2 space-y-2">
                        <li>
                            <a href="<?= base_url('/kriteria')?>"
                                class="<?= $active == 'Kriteria' ? 'dark:bg-gray-700 bg-gray-100': '' ?> flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">Kriteria</a>
                        </li>
                        <li>
                            <a href="<?= base_url('/sub-kriteria')?>"
                                class="<?= $active == 'SubKriteria' ? 'dark:bg-gray-700 bg-gray-100': '' ?> flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">Sub
                                Kriteria</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="<?= base_url('/alternative'); ?>"
                        class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white <?= $active == 'Alternative' ? 'dark:bg-gray-700 bg-gray-100': '' ?> hover:bg-gray-100 dark:hover:bg-gray-700 group">
                        <div
                            class="text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white w-5">
                            <i class="fa-solid fa-file"></i>
                        </div>

                        <span class="ms-3">Alternative</span>
                    </a>
                </li>
                <li>
                    <a href="<?= base_url('/penilaian'); ?>"
                        class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white <?= $active == 'Penilaian' ? 'dark:bg-gray-700 bg-gray-100': '' ?> hover:bg-gray-100 dark:hover:bg-gray-700 group">
                        <div
                            class="text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white w-5">
                            <i class="fa-solid fa-file-signature"></i>
                        </div>

                        <span class="ms-3">Penilaian</span>
                    </a>
                </li>
                <li>
                    <button type="button"
                        class="<?= $active == 'Bobot' || $active == 'Perhitungan' ? 'dark:bg-gray-700 bg-gray-100': '' ?> flex items-center w-full p-2 text-base text-gray-900 transition duration-75 rounded-lg group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700"
                        aria-controls="dropdown-proses" data-collapse-toggle="dropdown-proses">
                        <i class="fa-solid fa-chart-bar w-5 h-5"></i>
                        <span class="flex-1 ms-3 text-left rtl:text-right whitespace-nowrap">Proses</span>
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 4 4 4-4" />
                        </svg>
                    </button>
                    <ul id="dropdown-proses" class="hidden py-2 space-y-2">
                        <li>
                            <a href="<?= base_url('/bobot')?>"
                                class="<?= $active == 'Bobot' ? 'dark:bg-gray-700 bg-gray-100': '' ?> flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">Nilai
                                Gap</a>
                        </li>
                        <li>
                            <a href="<?= base_url('/perhitungan')?>"
                                class="<?= $active == 'Perhitungan' ? 'dark:bg-gray-700 bg-gray-100': '' ?> flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">Perhitungan</a>
                        </li>
                    </ul>

                </li>
                <li>
                    <a href="/logout"
                        class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                        <i class="fa-solid fa-right-from-bracket  w-5 h-5"></i>
                        <span class="flex-1 ms-3 whitespace-nowrap">Logout</span>
                    </a>
                </li>
            </ul>
        </div>
    </aside>

    <div class="p-4 sm:ml-64 print:ml-0">


        <?= $this->renderSection('main');?>

    </div>


    <script src="<?=base_url('/flowbite/dist/flowbite.min.js')?>"></script>
</body>

</html>