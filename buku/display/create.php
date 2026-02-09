<?php include_once(dirname(__DIR__, 2) . '/config.php');
startsect ?>


<section class="flex-1 w-full  sm:pl-8 " x-data="{editform:'',modal:false}">
    <div class="w-full h-12 text-2xl">book</div>
    <div class="w-full h-full bg-white pt-10 pl-5">
        <div class="w-full h-6 text-xl">Create</div>
        <section class="w-full h-full">
            <form action="" method="POST" class="w-3/5 mt-10">
                <label for="Judul" class="flex flex-col">
                    <span class="text-lg font-semibold font-serif">Judul</span>
                    <input type="text" name="Judul" id="Judul" x-model="editform.judul" class="pl-2 border rounded-full h-10 font-semibold font-mono bg-white">
                </label>

                <label for="Pengarang" class="flex flex-col">
                    <span class="text-lg font-semibold font-serif">Pengarang</span>
                    <input type="text" name="Pengarang" id="Pengarang" x-model="editform.pengarang" class="pl-2 border rounded-full h-10 font-semibold font-mono bg-white">
                </label>

                <label for="deskripsi" class="flex flex-col">
                    <span class="text-lg font-semibold font-serif">deskripsi</span>
                    <textarea type="text" name="deskripsi" id="deskripsi" x-model="editform.deskripsi" class="pl-2 border rounded-xl h-20 bg-white font-semibold font-mono"></textarea>
                </label>

                <label for="stok" class="flex flex-col">
                    <span class="text-lg font-semibold font-serif">stok</span>
                    <input type="text" name="stok" id="stok" x-model="editform.stok" class="pl-2 border rounded-full h-10 font-semibold font-mono bg-white">
                </label>

                <div class="gap-5 flex flex-row mt-12">
                    <button type="submit" class="bg-green-500 hover:bg-green-700 outline-slate-500 outline-2 hover:outline-offset-2  rounded-full w-24 h-10 text-center">Add</button>
                    <button type="reset" @click="modal=!modal" class="bg-red-500 hover:bg-red-700 outline-slate-500 outline-2 hover:outline-offset-2 rounded-full w-24 h-10 text-center">cancel</button>
                </div>
            </form>
        </section>
    </div>
</section>

<?php section(null, 'admin') ?>