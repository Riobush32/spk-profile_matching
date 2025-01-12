<?=$this->extend('layouts/main')?>

<?=$this->section('main')?>

<?= $this->include('components/breadcrumbs') ?>

<div class=" p-4 border-2  border-dashed rounded-lg border-gray-700 mt-5">
    <!-- Header -->
    <header class="bg-transparent text-white py-6">
        <div class="container mx-auto text-center">
            <h1 class="text-3xl font-bold">Dashboard SPK Profile Matching</h1>
            <nav class="mt-4">
                <ul class="flex justify-center space-x-6">
                    <li><a href="#company" class="hover:text-blue-300">Tentang Perusahaan</a></li>
                    <li><a href="#about" class="hover:text-blue-300">Tentang SPK</a></li>
                    <li><a href="#formulas" class="hover:text-blue-300">Rumus</a></li>
                    <li><a href="#steps" class="hover:text-blue-300">Langkah Pengerjaan</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <!-- Main Content -->
    <main class="container mx-auto py-10 px-4">
        <!-- Tentang Perusahaan -->
        <section id="company" class="mb-8 bg-white p-6 rounded-lg shadow-md">
            <h2 class="text-2xl font-semibold mb-4">Tentang PERUMDA Air Minum Tirta Silaupiasa</h2>
            <p>
                <strong>PERUMDA Air Minum Tirta Silaupiasa</strong> adalah perusahaan milik daerah di Kabupaten Asahan,
                Sumatera Utara, yang bergerak di bidang penyediaan air bersih bagi masyarakat.
                Kantor pusatnya terletak di <strong>Jl. Jend. Ahmad Yani No. 33, Sei Renggas, Kecamatan Kota Kisaran
                    Barat, Kabupaten Asahan, Sumatera Utara 21213</strong>.
            </p>
            <p class="mt-2">
                <strong>Layanan Utama:</strong>
            <ul class="list-disc list-inside">
                <li>Pembayaran tagihan air.</li>
                <li>Pemasangan sambungan baru dengan persyaratan tertentu.</li>
                <li>Penanganan keluhan pelanggan, seperti kebocoran atau masalah distribusi air.</li>
            </ul>
            </p>
            <p class="mt-2">
                <strong>VISI</strong>
            <ul class="list-disc list-inside">
                <li>Menjadi Perusahaan Umum Daerah Air Minum yang dapat memberikan
                    kepuasan kepada konsumen.</li>
            </ul>
            </p>
            <p class="mt-2">
                <strong>MISI</strong>
            <ul class="list-disc list-inside">
                <li>Mandiri dalam pengelolaan perusahaan.</li>
                <li>Memberikan Pelayanan Prima secara efektif dan efisien.</li>
                <li>Menyediakan Air Minum yang terjangkau masyarakat dengan memenuhi
                    standar kapasitas kuantitas dan kualitas kesehatan.</li>
                <li>Mengembangkan kapasitas pegawai yang professional dengan menerapkan
                    teknologi tepat guna.</li>
                <li>Memberikan konstribusi kepada Pemerintah Kabupaten Asahan untuk
                    pembangunan yang berkesinambungan.</li>
            </ul>
            </p>
            <!-- <p class="mt-2">
                Untuk informasi lebih lanjut, hubungi nomor telepon <strong>(0623) 41091</strong> atau kunjungi kantor
                pusatnya.
            </p> -->
        </section>
        <!-- Tentang SPK -->
        <section id="about" class="mb-8 bg-white p-6 rounded-lg shadow-md">
            <h2 class="text-2xl font-semibold mb-4">Apa itu SPK Profile Matching?</h2>
            <p>SPK Profile Matching adalah metode yang digunakan untuk membandingkan profil individu dengan profil yang
                diharapkan berdasarkan kriteria tertentu. Metode ini sering digunakan dalam proses rekrutmen, penilaian
                kinerja, atau pengambilan keputusan lainnya.</p>
        </section>

        <!-- Rumus -->
        <section id="formulas" class="mb-8 bg-white p-6 rounded-lg shadow-md">
            <h2 class="text-2xl font-semibold mb-4">Rumus-rumus dalam Profile Matching</h2>
            <ul class="list-disc list-inside">
                <li><strong>Selisih:</strong>
                    <code
                        class="bg-gray-100 px-2 py-1 rounded">Selisih = Nilai Alternative - Nilai Target(Nilai Standar)</code>
                </li>
                <li><strong>Bobot Nilai:</strong>
                    <code class="bg-gray-100 px-2 py-1 rounded">Nilai Gap = Bobot sesuai Tabel Bobot</code>
                </li>
                <li><strong>Nilai Akhir:</strong>
                    <code
                        class="bg-gray-100 px-2 py-1 rounded">Final Score = (Persentase Core Factor * rata-rata Core Factor) + (Persentase Secondary Factor * rata-rata Secondary Factor)</code>
                </li>
            </ul>
        </section>

        <!-- Langkah Pengerjaan -->
        <section id="steps" class="mb-8 bg-white p-6 rounded-lg shadow-md">
            <h2 class="text-2xl font-semibold mb-4">Langkah Pengerjaan</h2>
            <ol class="list-decimal list-inside space-y-2">
                <li>Tentukan kriteria penilaian.</li>
                <li>Identifikasi nilai standar untuk setiap kriteria.</li>
                <li>Bandingkan nilai alternative dengan nilai standar menggunakan rumus selisih.</li>
                <li>Konversi nilai selisih menjadi bobot berdasarkan tabel bobot.</li>
                <li>Hitung nilai Final Score</li>
            </ol>
        </section>

        <!-- Profil Pembuat -->
        <section id="creator" class="bg-white p-6 rounded-lg shadow-md">
            <h2 class="text-2xl font-semibold mb-4">Profil Pembuat</h2>
            <div class="flex items-center space-x-4">
                <img src="https://via.placeholder.com/100" alt="Foto Pembuat" class="w-20 h-20 rounded-full">
                <div>
                    <h3 class="text-xl font-semibold">TIOFANI BR HUTAPEA</h3>
                    <p class="text-gray-600">Mahasiswa Sistem Informasi Universitas Royal Kisaran</p>
                    <!-- <p class="text-gray-600 mt-2">Hubungi: <a href="mailto:email@example.com"
                            class="text-blue-600 hover:underline">email@example.com</a></p> -->
                </div>
            </div>
        </section>
    </main>

    <!-- Footer -->
    <footer class="bg-transparent rounded-xl text-amber-300 py-4 text-center">
        <p>&copy; 2025 SPK Profile Matching. All rights reserved.</p>
    </footer>

</div>

<?=$this->endSection();?>