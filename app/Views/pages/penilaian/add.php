<?=$this->extend('layouts/main')?>

<?=$this->section('main')?>

<?= $this->include('components/breadcrumbs') ?>

<?php if (session()->getFlashdata('errors')): ?>
<?php foreach (session()->getFlashdata('errors') as $error): ?>
<div class="absolute top-20 right-20" x-data="{ tampil: true }">
    <div x-init="setTimeout(() => tampil = false, 3000)" x-show="tampil"
        x-transition:enter="transition ease-in-out duration-300" x-transition:enter-start="opacity-0 scale-90"
        x-transition:enter-end="opacity-100 scale-100" x-transition:leave="transition ease-in duration-300"
        x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-90"
        class="flex items-center p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400"
        role="alert">
        <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
            fill="currentColor" viewBox="0 0 20 20">
            <path
                d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
        </svg>
        <span class="sr-only">Info</span>
        <div>
            <span class="font-medium">Danger alert!</span> <?= $error ?>
        </div>
    </div>
</div>

<?php endforeach; ?>
<?php endif; ?>



<div
    class="flex justify-between items-center p-4 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700 mt-5 dark:text-white">
    <div class="">
        <?= $title ?>
    </div>
    <div class="">
        <a href="/penilaian"
            class="text-gray-900 bg-gradient-to-r from-lime-200 via-lime-400 to-lime-500 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-lime-300 dark:focus:ring-lime-800 dark:text-white shadow-lg shadow-lime-500/50 dark:shadow-lg dark:shadow-lime-800/80 font-medium rounded-lg text-sm px-5 py-2.5 text-center cursor-pointer"><i
                class="fa-solid fa-arrow-left"></i>
        </a>
    </div>
</div>

<div class="w-full flex justify-start items-center ">
    <form action="/penilaian/store" method="post"
        class="w-96 p-4 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700 mt-5 dark:text-white">
        <?= csrf_field()?>
        <div>
            <label for="small-input"
                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Alternaive</label>
            <select id="small" name="alternative" required
                class="block w-full p-2 mb-6 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 invalid:focus:ring-rose-500 invalid:focus:border-rose-500">
                <option selected disabled>Pilih Alternative</option>
                <?php foreach($alternative as $item): ?>
                <option value="<?=$item['id']?>"><?=$item['nama_alternative']?></option>
                <?php endforeach; ?>foreach; ?>
            </select>
        </div>
        <?php foreach($kriteria as $row): ?>
        <div class="mt-3">
            <label for="small"
                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"><?=$row['nama_kriteria']?></label>
            <select id="small" name="subkriteria_<?=$row['id']?>" required
                class="block w-full p-2 mb-6 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 invalid:focus:ring-rose-500 invalid:focus:border-rose-500">
                <option selected disabled>Pilih Subkriteria <?=$row['nama_kriteria']?></option>
                <?php 
                    $id = $row['id'];
                    $data = $sub_kriteria_model->getAllWithKriteriaById($id);
                    
                    foreach($data as $item): 
                ?>
                <option value="<?=$item['id']?>"><?=$item['nama_kriteria']?> → <?=$item['nama_subkriteria']?> =
                    <?=$item['nilai']?>
                </option>
                <?php endforeach; ?>

            </select>
        </div>
        <?php endforeach; ?>
        <div class="flex justify-end w-full">
            <button type="submit"
                class="text-white bg-gradient-to-r from-purple-500 via-purple-600 to-purple-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-purple-300 dark:focus:ring-purple-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2 mt-3">Save</button>
        </div>

    </form>
</div>


<?=$this->endSection();?>