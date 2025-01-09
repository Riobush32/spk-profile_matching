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
        table th {
            white-space: normal !important;
            word-wrap: break-word;
            text-align: start;
            vertical-align: middle;
        }

        .page-break {
            break-inside: avoid;
            /* Membuat elemen ini mulai di halaman baru */
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
                                Bobot</a>
                        </li>
                        <li>
                            <a href="<?= base_url('/perhitungan')?>"
                                class="<?= $active == 'Perhitungan' ? 'dark:bg-gray-700 bg-gray-100': '' ?> flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">Perhitungan</a>
                        </li>
                    </ul>

                </li>
                <li>
                    <a href="#"
                        class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                        <svg class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"
                            aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                            viewBox="0 0 20 20">
                            <path d="M5 5V.13a2.96 2.96 0 0 0-1.293.749L.879 3.707A2.96 2.96 0 0 0 .13 5H5Z" />
                            <path
                                d="M6.737 11.061a2.961 2.961 0 0 1 .81-1.515l6.117-6.116A4.839 4.839 0 0 1 16 2.141V2a1.97 1.97 0 0 0-1.933-2H7v5a2 2 0 0 1-2 2H0v11a1.969 1.969 0 0 0 1.933 2h12.134A1.97 1.97 0 0 0 16 18v-3.093l-1.546 1.546c-.413.413-.94.695-1.513.81l-3.4.679a2.947 2.947 0 0 1-1.85-.227 2.96 2.96 0 0 1-1.635-3.257l.681-3.397Z" />
                            <path
                                d="M8.961 16a.93.93 0 0 0 .189-.019l3.4-.679a.961.961 0 0 0 .49-.263l6.118-6.117a2.884 2.884 0 0 0-4.079-4.078l-6.117 6.117a.96.96 0 0 0-.263.491l-.679 3.4A.961.961 0 0 0 8.961 16Zm7.477-9.8a.958.958 0 0 1 .68-.281.961.961 0 0 1 .682 1.644l-.315.315-1.36-1.36.313-.318Zm-5.911 5.911 4.236-4.236 1.359 1.359-4.236 4.237-1.7.339.341-1.699Z" />
                        </svg>
                        <span class="flex-1 ms-3 whitespace-nowrap">Sign Up</span>
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