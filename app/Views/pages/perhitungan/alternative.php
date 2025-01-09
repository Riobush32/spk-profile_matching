<div
    class=" p-4 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700 mt-2 group hover:border-cyan-200 transition ease-in-out duration-300">
    <h1 class="text-white print:text-black group-hover:text-amber-300 transition ease-in-out duration-300 text-2xl">
        Table Alternative
    </h1>
    <hr
        class="h-px mb-8 mt-3 group-hover:bg-cyan-300 transition ease-in-out duration-300 bg-gray-200 border-0 dark:bg-gray-700">
    <table id="search-table" class="text-white">
        <caption class="caption-bottom">
            Table Alternative
        </caption>
        <thead>

        </thead>
    </table>
</div>

<script>
const tableData = <?= json_encode($results); ?>;
const kriteriasHeaders = <?= json_encode(array_map(fn($kri) => $kri['nama_kriteria'], $kriterias)); ?>;

const headings = ['Alternatif', ...kriteriasHeaders.map(header => header.replace(' ', '\n'))];

const formattedData = tableData.map(row => {
    const rowData = [row.nama_alternative];
    <?php foreach ($kriterias as $kri): ?>
    rowData.push(row['kriteria_<?= $kri['id'] ?>']);
    <?php endforeach; ?>
    return rowData;
});

if (document.getElementById("search-table")) {
    const dataTable = new simpleDatatables.DataTable("#search-table", {
        data: {
            headings: headings, // Header kolom
            data: formattedData // Data untuk baris
        },
        searchable: true, // Mengaktifkan pencarian
        sortable: true // Mengaktifkan pengurutan
    });
}

document.addEventListener('click', function(event) {
    if (event.target.classList.contains('delete-btn')) {
        const id = event.target.getAttribute('data-id');
        if (confirm('Yakin ingin menghapus data ini?')) {
            alert(`Hapus ID: ${id}`);
            // Tambahkan logika AJAX untuk penghapusan
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