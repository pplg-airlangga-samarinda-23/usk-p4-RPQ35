<?php include_once(dirname(__DIR__, 2) . '/config.php');
startsect ?>


<section class="flex-1 w-full pl-8 " x-data="{editform:'',modal:false}">
    <div class="w-full h-12 text-2xl">Form peminjaman</div>
    <div class="w-full h-full bg-white pt-10 pl-5">
        <div class="w-full h-6 text-xl">Form</div>
        <section class="w-full h-full">
            <form action="mboh.php" method="POST" class="w-3/5 mt-10">
                <div x-data='{ 
                    editform: { judul: "", pengarang: "" },
                    showJudulList: false,
                    /* Data ini biasanya didapat dari PHP fetchAll */
                    books: <?= (json_encode($data)) ?>,
                    
                    get filteredBooks() {
                        if (this.editform.judul === "") return [];
                        return this.books.filter(b => 
                            b.judul.toLowerCase().includes(this.editform.judul.toLowerCase())
                        );
                    },

                    selectBook(book) {
                        this.editform.judul = book.judul;
                        this.editform.pengarang = book.pengarang;
                        this.editform.id = book.id;
                        this.showJudulList = false;
                    }
                }' class="space-y-6 p-4">

                    <label for="Judul" class="flex flex-col relative">
                        <span class="text-lg font-semibold font-serif">Judul</span>
                        <input
                            type="text"
                            name="Judul"
                            id="Judul"
                            x-model="editform.judul"
                            @input="showJudulList = true"
                            @click.away="showJudulList = false"
                            autocomplete="off"
                            class="pl-4 border rounded-full h-10 font-semibold font-mono bg-white focus:outline-blue-500">

                        <ul x-show="showJudulList && filteredBooks.length > 0"
                            class="absolute z-10 w-full bg-white border rounded-xl mt-20 shadow-xl overflow-hidden">
                            <template x-for="book in filteredBooks" :key="book.judul">
                                <li @click="selectBook(book)"
                                    class="px-4 py-2 hover:bg-blue-100 cursor-pointer flex justify-between">
                                    <span x-text="book.judul" class="font-bold"></span>
                                    <span x-text="book.pengarang" class="text-gray-500 text-sm italic"></span>
                                </li>
                            </template>
                        </ul>
                    </label>

                    <label for="Pengarang" class="flex flex-col">
                        <span class="text-lg font-semibold font-serif">Pengarang</span>
                        <input
                            type="text"
                            name="Pengarang"
                            id="Pengarang"
                            x-model="editform.pengarang"
                            class="pl-4 border rounded-full h-10 font-semibold font-mono bg-gray-50"
                            placeholder="Otomatis terisi...">
                    </label>

                    <input type="hidden" name="book_id" x-model="editform.id">
                </div>

                <label for="Tanggal_kembali" class="flex flex-col mt-10">
                    <span class="text-lg font-semibold font-serif">Tanggal kembali</span>
                    <input type="text" name="Tanggal_kembali" id="Tanggal_kembali" class="pl-2 border rounded-full h-10 font-semibold font-mono bg-white w-27" value="<?= (strval(((new DateTime())->modify("+7 days"))->format("Y-m-d"))) ?>" disabled>
                </label>

                <div class="gap-5 flex flex-row mt-12">
                    <button type="submit" class="bg-green-500 hover:bg-green-700 outline-slate-500 outline-2 hover:outline-offset-2  rounded-full w-24 h-10 text-center">Add</button>
                    <button type="reset" class="bg-red-500 hover:bg-red-700 outline-slate-500 outline-2 hover:outline-offset-2 rounded-full w-24 h-10 text-center">cancel</button>
                </div>
            </form>
        </section>
    </div>
</section>

<?php section(null,) ?>