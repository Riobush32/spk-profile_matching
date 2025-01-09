<?=$this->extend('layouts/main')?>

<?=$this->section('main')?>

<?= $this->include('components/breadcrumbs') ?>

<?= $this->include('pages/perhitungan/alert.php') ?>

<div
    class="print:max-w-3xl print:mx-auto print:bg-white print:shadow-md print:p-6 print:mt-10 print:border print:rounded-md">

    <!-- Header -->
    <div class="print:flex hidden items-center border-b pb-4 mb-6">
        <!-- Logo -->
        <div class="w-24 h-24">
            <img src="<?=base_url('assets/img/ur.png')?>" alt="Logo" class="object-cover">
        </div>
        <!-- Informasi Perusahaan -->
        <div class="ml-6">
            <h1 class="text-2xl font-bold uppercase">Universitas Royal Kisaran</h1>
            <p class="text-gray-700">Jl. Prof.H.M.Yamin No.173, Kisaran Naga, Kisaran Timur., Kabupaten Asahan, Sumatera
                Utara 21222 Indonesia</p>
            <p class="text-gray-700">Telp: 0623 - 41079 | Email: info@universitasroyal.ac.id</p>
        </div>
    </div>
    <!-- Judul Surat -->
    <div class="print:block hidden text-center mb-6">
        <h2 class="text-lg font-bold uppercase">Surat Laporant Hasil Perhitungan</h2>
        <!-- <p class="text-sm text-gray-600">Nomor: 001/ABCD/2025</p> -->
    </div>

    <!-- Isi Surat -->
    <div class="print:block hidden text-justify leading-relaxed text-gray-800">
        <p>Kepada Yth,</p>
        <p><strong>Bapak/Ibu [Nama Penerima]</strong></p>
        <p>Dengan hormat,</p>
        <p>Melalui surat ini kami menyampaikan bahwa <strong>hasil perhitungan dengan metode profile maching</strong>
            adalah sebagaimana yang telah di jabarkan dibawah ini. Surat ini kami buat sebagai bukti yang sah sesuai
            dengan kebutuhan.</p>
        <p>Demikian surat ini kami sampaikan, atas perhatian dan kerjasamanya kami ucapkan terima kasih.</p>
    </div>

    <div
        class="print:text-black print:border-none p-4 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700 mt-2 group hover:border-cyan-200 transition ease-in-out duration-300 flex justify-between items-center">
        <div
            class="text-white print:text-black print:group-hover:text-black group-hover:text-amber-300 transition ease-in-out duration-300 text-2xl">
            <?= $title ?>
        </div>
        <button type="button"
            class="print:hidden text-white bg-gradient-to-r from-teal-400 via-teal-500 to-teal-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-teal-300 dark:focus:ring-teal-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center "><i
                class="fa-solid fa-print" onclick="printPage()"></i></button>
    </div>

    <?= $this->include('pages/perhitungan/nilai_standar.php') ?>

    <?php if($proses): ?>
    <?= $this->include('pages/perhitungan/hasil_akhir.php') ?>
    <?= $this->include('pages/perhitungan/alternative.php') ?>
    <!-- Selisih  -->
    <?= $this->include('pages/perhitungan/selisih.php') ?>
    <!-- Gap  -->
    <?= $this->include('pages/perhitungan/gap.php') ?>
    <!-- final score  -->
    <?= $this->include('pages/perhitungan/final_score.php') ?>

    <?php endif; ?>
    <!-- Tanda Tangan -->
    <div class="print:flex hidden justify-between mt-8">
        <div class="text-center">
            <p class="text-sm">Hormat Kami,</p>
            <p class="mt-16">[Nama Penanggung Jawab]</p>
            <p class="text-sm">[Jabatan]</p>
        </div>
        <div class="text-center">
            <p class="text-sm">Mengetahui,</p>
            <p class="mt-16">[Nama Pimpinan]</p>
            <p class="text-sm">[Jabatan]</p>
        </div>
    </div>
</div>
<script>
const rangeInput = document.getElementById('default-range');
const coreValue = document.getElementById('core-value');
const secondaryValue = document.getElementById('secondary-value');

// Event listener untuk menangkap perubahan nilai range
rangeInput.addEventListener('input', () => {
    coreValue.textContent = rangeInput.value; // Tampilkan nilai di span
    secondaryValue.textContent = 100 - rangeInput.value; // Tampilkan nilai di span
});
</script>

<script>
function printPage() {
    window.print(); // Memanggil fungsi bawaan untuk mencetak
}
</script>

<?=$this->endSection();?>