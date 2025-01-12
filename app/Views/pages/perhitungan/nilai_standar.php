<div
    class="print:hidden p-4 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700 mt-2 group hover:border-cyan-200 transition ease-in-out duration-300">
    <h1 class="text-white group-hover:text-amber-300 transition ease-in-out duration-300 text-2xl">

        Nilai
        Standar
    </h1>
    <hr
        class="h-px mb-8 mt-3 group-hover:bg-cyan-300 transition ease-in-out duration-300 bg-gray-200 border-0 dark:bg-gray-700">
    <form action="/perhitungan/" method="POST">
        <?= csrf_field()?>
        <div class="mt-5 grid grid-cols-1 md:grid-cols-4 gap-1 md:gap-4 ">
            <?php foreach($kriterias as $index => $kriteria): ?>
            <div class="mt-3">
                <label for="small"
                    class="group-hover:text-amber-300 block mb-2 text-sm font-medium text-gray-900 dark:text-white"><?=$kriteria['nama_kriteria']?></label>
                <select id="small" name="kriteria_<?=$kriteria['id']?>" required
                    class="block w-full p-2 mb-6 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 invalid:focus:ring-rose-500 invalid:focus:border-rose-500">
                    <?php if($proses): ?>
                    <option value="<?=$nilai_standar[$index]['subkriteria_id']?>">
                        <?=$nilai_standar[$index]['nama_subkriteria']?> → <?=$nilai_standar[$index]['nilai']?></option>
                    <?php else: ?>
                    <option selected disabled>Pilih Subkriteria <?=$kriteria['nama_kriteria']?></option>
                    <?php endif; ?>

                    <?php 
                    $id = $kriteria['id'];
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

        </div>
        <div class="mt-8">

            <label for="default-range"
                class="group-hover:text-yellow-300 block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                Factor
            </label>

            <?php if($proses): ?>
            <input id="default-range" type="range" value="<?=$core_factor?>" min="0" max="100" name="factor"
                class="w-full h-2 bg-gray-200 rounded-lg appearance-none cursor-pointer dark:bg-gray-700">
            <div class="flex gap-5 mt-2 text-sm font-medium text-gray-900 dark:text-white">
                <div class="text-white group-hover:text-fuchsia-300">
                    Core Faktor: <span id="core-value"><?=$core_factor ?></span>%
                </div>
                <div class="text-white group-hover:text-lime-300">
                    Secondary Faktor: <span id="secondary-value"><?=100-$core_factor ?></span>%
                </div>

            </div>
            <?php else: ?>
            <input id="default-range" type="range" value="50" min="0" max="100" name="factor"
                class="w-full h-2 bg-gray-200 rounded-lg appearance-none cursor-pointer dark:bg-gray-700">
            <div class="flex gap-5 mt-2 text-sm font-medium text-gray-900 dark:text-white">
                <div class="text-white group-hover:text-fuchsia-300">
                    Core Faktor: <span id="core-value">50</span>%
                </div>
                <div class="text-white group-hover:text-lime-300">
                    Secondary Faktor: <span id="secondary-value">50</span>%
                </div>

            </div>
            <?php endif; ?>


        </div>
        <div class="mt-8 flex justify-end">
            <button
                class="relative inline-flex items-center justify-center p-0.5 mb-2 me-2 overflow-hidden text-sm font-medium text-gray-900 rounded-lg group bg-gradient-to-br from-pink-500 to-orange-400 group-hover:from-pink-500 group-hover:to-orange-400 hover:text-white dark:text-white focus:ring-4 focus:outline-none focus:ring-pink-200 dark:focus:ring-pink-800">
                <span
                    class="relative px-5 py-2.5 transition-all ease-in duration-75 bg-white dark:bg-gray-900 rounded-md group-hover:bg-opacity-0">
                    Pink to orange
                </span>
            </button>
        </div>
    </form>
</div>

<?php if ($proses):?>
<div
    class="hidden print:block p-4 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700 mt-2 group hover:border-cyan-200 transition ease-in-out duration-300">
    <h1 class="text-black group-hover:text-amber-300 transition ease-in-out duration-300 text-2xl">

        Nilai
        Standar
    </h1>
    <hr
        class="h-px mb-8 mt-3 group-hover:bg-cyan-300 transition ease-in-out duration-300 bg-gray-200 border-0 dark:bg-gray-700">

    <div class="mt-5 grid grid-cols-4 gap-4 text-black">
        <?php foreach($kriterias as $index => $kriteria): ?>
        <div class="font-bold"><?=$kriteria['nama_kriteria']?></div>
        <div class="">: <?=$nilai_standar[$index]['nilai']?></div>
        <?php endforeach; ?>
        <div class="font-bold">Core Factor</div>
        <div class=""><?=$core_factor?></div>
        <div class="font-bold">Secondary Factor</div>
        <div class=""><?=100-$core_factor ?></div>
    </div>
</div>
<?php endif; ?>