<?php include_once(dirname(__DIR__, 2) . '/config.php');
startsect ?>


<section class="flex-1 w-full pl-8 " x-data="{editform:'',modal:false}">
    <div class="w-full h-12">User</div>
    <div class="w-full h-full bg-white pt-10 pl-5">
        <section
            class="w-[900px] outline outline-offset-2 p-4 rounded-lg mx-auto bg-white"
            x-data="bookTable">
            <div class="w-full flex flex-row justify-between mb-4">
                <input
                    type="text"
                    x-model="search"
                    @input="currentPage = 1"
                    placeholder="Search and sort...."
                    class="w-98 p-2 border border-slate-300 rounded-lg outline-none focus:ring-2 focus:ring-sky-300">
                <!-- <a href="<?= $curent_url . "create.php" ?>"> <button class="rounded-xl w-18 h-10 bg-sky-500 outline-3 outline-slate-300 hover:outline-offset-2 hover:bg-sky-700 active:text-white ">Create</button></a> -->
            </div>

            <table class="table-auto border-collapse w-full">
                <thead>
                    <tr>
                        <th class="bg-sky-300 p-2 text-center rounded-tl-lg w-[50px]">id</th>
                        <th class="bg-sky-300 p-2 text-center">Username</th>
                        <th class="bg-sky-300 p-2 text-center">buku</th>
                        <th class="bg-sky-300 p-2 text-center">tanggal dipinjam</th>
                        <th class="bg-sky-300 p-2 text-center">tanggal kembali</th>
                        <th class="bg-sky-300 p-2 text-center">status</th>
                        <th class="bg-sky-300 p-2 text-center">denda</th>
                        <th class="bg-sky-300 p-2 text-center rounded-tr-lg">action</th>
                    </tr>
                </thead>
                <tbody>
                    <template x-for="(book, index) in paginatedBooks">
                        <tr class="border-b border-slate-100 hover:bg-slate-50">
                            <td class="text-center p-2 border-r" x-text="((currentPage - 1) * pageSize) + index + 1"></td>
                            <td class="p-2" x-text="book.username_peminjam"></td>
                            <td class="p-2" x-text="book.judul_buku"></td>
                            <td class="p-2" x-text="book.tgl_pinjam"></td>
                            <td class="p-2" x-text="book.tgl_kembali"></td>
                            <td class="p-2" x-text="book.status"></td>
                            <td class="p-2" x-text="book.denda"></td>
                            <td class="p-2 text-center">
                                <div class="flex gap-2 justify-center">
                                    <button @click="modal=true,editform={...book}" class="bg-yellow-400 px-3 py-1 rounded-xl text-sm">edit</button>
                                </div>
                            </td>
                        </tr>
                    </template>
                </tbody>
            </table>

            <div class="mt-4 flex justify-between items-center">
                <span class="text-sm text-gray-500" x-text="`Showing ${paginatedBooks.length} entries` "></span>
                <div class="flex gap-1">
                    <button @click="currentPage--" :disabled="currentPage === 1" class="px-3 py-1 border rounded disabled:opacity-50">Prev</button>
                    <button @click="currentPage++" :disabled="currentPage === totalPages" class="px-3 py-1 border rounded disabled:opacity-50">Next</button>
                </div>
            </div>
        </section>

        <script>
            document.addEventListener('alpine:init', () => {
                Alpine.data('bookTable', () => ({
                    search: '',
                    currentPage: 1,
                    pageSize: 5,
                    allBooks: <?= json_encode($data ?? []) ?>,

                    get filteredBooks() {
                        if (!this.search) return this.allBooks;
                        return this.allBooks.filter(book =>
                            book.username_peminjam.toLowerCase().includes(this.search.toLowerCase()) ||
                            book.judul_buku.toLowerCase().includes(this.search.toLowerCase()) ||
                            book.tgl_pinjam.toLowerCase().includes(this.search.toLowerCase()) ||
                            book.tgl_kembali.toLowerCase().includes(this.search.toLowerCase()) ||
                            book.status.toLowerCase().includes(this.search.toLowerCase()) ||
                            book.denda.toLowerCase().includes(this.search.toLowerCase())
                        );
                    },

                    get paginatedBooks() {
                        let start = (this.currentPage - 1) * this.pageSize;
                        return this.filteredBooks.slice(start, start + this.pageSize);
                    },

                    get totalPages() {
                        return Math.ceil(this.filteredBooks.length / this.pageSize);
                    },


                }))
            })
        </script>
    </div>
    <section x-show="modal" class="bg-stone-500/30 w-full h-full fixed top-0 flex flex-row justify-center items-center ">
        <div class="bg-sky-400/98 w-98 h-98 outline-2 outline-offset-4 outline-slate-500 rounded-xl">
            <form action='<?= $curent_url ?>update.php' class="w-full h-full relative p-3 " method="post">
                <label class="w-full flex flex-row justify-center items-center">
                    <span class="text-xl font-bold ">Edit data</span>
                </label>

                <input type="hidden" name="ids" x-model="editform.id">

                <label for="denda" class="flex flex-col">
                    <span class="text-lg font-semibold font-serif">denda</span>
                    <input type="number" name="denda" id="denda" x-model="editform.denda" class="pl-2 border rounded-full h-10 font-semibold font-mono bg-white">
                </label>



                <div class="gap-5 flex flex-row absolute bottom-0 mt-2">
                    <button type="submit" class="bg-green-500 hover:bg-green-700 outline-slate-500 outline-2 hover:outline-offset-2  rounded-full w-24 h-10 text-center">Add</button>
                    <button type="reset" @click="modal=!modal" class="bg-red-500 hover:bg-red-700 outline-slate-500 outline-2 hover:outline-offset-2 rounded-full w-24 h-10 text-center">cancel</button>
                </div>
            </form>
        </div>
    </section>
</section>

<?php section(null, 'admin') ?>