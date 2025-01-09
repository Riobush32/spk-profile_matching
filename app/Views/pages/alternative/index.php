<?=$this->extend('layouts/main')?>

<?=$this->section('main')?>

<?= $this->include('components/breadcrumbs') ?>

<?php if (session()->getFlashdata('success')): ?>
<div class="absolute top-20 right-20" x-data="{ flash_messege: true }">
    <div x-init="setTimeout(() => flash_messege = false, 3000)" x-show="flash_messege"
        x-transition:enter="transition ease-in-out duration-300" x-transition:enter-start="opacity-0 scale-90"
        x-transition:enter-end="opacity-100 scale-100" x-transition:leave="transition ease-in duration-300"
        x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-90"
        class="flex items-center p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400"
        role="alert">
        <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
            fill="currentColor" viewBox="0 0 20 20">
            <path
                d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
        </svg>
        <span class="sr-only">Info</span>
        <div>
            <span class="font-medium">Success alert!</span> <?= session()->getFlashdata('success') ?>
        </div>
    </div>
</div>
<?php endif; ?>


<div
    class="flex justify-between items-center p-4 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700 mt-5 dark:text-white">
    <div class="">
        <?= $title ?>
    </div>
    <div class="">
        <a href="/alternative/add"
            class="text-white bg-gradient-to-r from-green-400 via-green-500 to-green-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-green-300 dark:focus:ring-green-800 shadow-lg shadow-green-500/50 dark:shadow-lg dark:shadow-green-800/80 font-medium rounded-lg text-sm px-5 py-2.5 text-center cursor-pointer"><i
                class="fa-solid fa-plus"></i> <span>Add</span>
        </a>
    </div>
</div>

<div class="p-4 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700 mt-2">
    <table id="search-table">
        <caption class="caption-bottom">
            Table 3.1: Professional wrestlers and their signature moves.
        </caption>
        <thead>
            <tr>
                <th>
                    <span class="flex items-center">
                        Nama Alternative
                    </span>
                </th>
                <th>
                    <span class="flex items-center">
                        action
                    </span>
                </th>
            </tr>
        </thead>
        <tbody>

        </tbody>
    </table>
</div>

<div id="popup-modal" tabindex="-1"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <button type="button"
                class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                data-modal-hide="popup-modal">
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                </svg>
                <span class="sr-only">Close modal</span>
            </button>
            <div class="p-4 md:p-5 text-center">
                <i class="fa-solid fa-circle-exclamation text-amber-400 text-5xl my-5"></i>
                <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">
                    Are you sure you want to delete this item?
                </h3>
                <div class="flex gap-3 w-full justify-center items-center">
                    <form id="deleteForm" action="/alternative/delete" method="POST">
                        <?= csrf_field() ?>
                        <input type="hidden" name="id" id="deleteId" value="">
                        <input type="hidden" name="_method" value="DELETE">
                        <button type="submit"
                            class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                            Yes, I'm sure
                        </button>
                    </form>
                    <button data-modal-hide="popup-modal" type="button"
                        class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">No,
                        cancel</button>
                </div>

            </div>
        </div>
    </div>
</div>

<script>
const alternativeData = <?= json_encode($alternative); ?>;
// Siapkan data untuk DataTable
const tableData = alternativeData.map(alternative => [
    alternative.nama_alternative, // Misalnya kolom 'nama_alternative'
    `<a href="/alternative/edit/${alternative.id}" class="text-white bg-gradient-to-r from-teal-400 via-teal-500 to-teal-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-teal-300 dark:focus:ring-teal-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2" data-id="${alternative.id}"><i class="fa-solid fa-pen-to-square"></i></a>` +
    // Tombol Edit
    `<button data-modal-target="popup-modal" data-modal-toggle="popup-modal" class="text-white bg-gradient-to-r from-red-400 via-red-500 to-red-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2" data-id="${alternative.id}"><i class="fa-solid fa-trash"></i></button>` // Tombol Delete
]);

if (document.getElementById("search-table") && typeof simpleDatatables.DataTable !== 'undefined') {
    const dataTable = new simpleDatatables.DataTable("#search-table", {
        data: {
            headings: ["Nama alternative", "action"], // Header kolom
            data: tableData // Data yang sudah disiapkan
        },
        searchable: true, // Mengaktifkan pencarian
        sortable: true // Mengaktifkan pengurutan
    });
}

// Menambahkan event listener untuk tombol Edit dan Delete
document.addEventListener('click', function(event) {
    if (event.target.classList.contains('edit-btn')) {
        const id = event.target.getAttribute('data-id');
        alert(`Edit ID: ${id}`); // Contoh aksi edit
        // Anda bisa menambahkan logika untuk membuka halaman edit
    }

    if (event.target.classList.contains('delete-btn')) {
        const id = event.target.getAttribute('data-id');
        if (confirm('Apakah Anda yakin ingin menghapus data ini?')) {
            // Logika untuk menghapus data (bisa menggunakan AJAX untuk mengirimkan permintaan ke server)
            alert(`Hapus ID: ${id}`);
        }
    }
});

// Tangkap semua tombol delete
const deleteButtons = document.querySelectorAll('[data-modal-toggle="popup-modal"]');

// Tambahkan event listener ke setiap tombol delete
deleteButtons.forEach(button => {
    button.addEventListener('click', function() {
        const id = this.getAttribute('data-id'); // Ambil ID dari atribut data-id
        document.getElementById('deleteId').value = id; // Set value pada input hidden
    });
});
</script>



<?=$this->endSection();?>