<div
    class="page-break printable-section p-4 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700 mt-2 group hover:border-cyan-200 transition ease-in-out duration-300">
    <h1 class="print:text-black text-white group-hover:text-amber-300 transition ease-in-out duration-300 text-2xl">
        Final Score
    </h1>
    <hr
        class="h-px mb-8 mt-3 group-hover:bg-cyan-300 transition ease-in-out duration-300 bg-gray-200 border-0 dark:bg-gray-700">

    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table
            class="w-full text-sm text-left rtl:text-right group-hover:text-amber-300 text-gray-500 dark:text-gray-400">
            <thead
                class="text-xs group-hover:text-amber-300 text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Alternative
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Score
                    </th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($final_score as $score): ?>
                <tr
                    class="odd:bg-white group-hover:text-amber-300 odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                    <th scope="row"
                        class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white group-hover:text-amber-300">
                        <?=$score['alternative']?>
                    </th>
                    <td class="px-6 py-4 group-hover:text-amber-300">
                        <?=$score['score']?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

</div>