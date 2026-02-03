<?php include_once(dirname(__DIR__, 2) . '../config.php');
startsect ?>


<section class="flex-1 w-full pl-8 " x-data="{editform:'',modal:false}">
    <div class="w-full h-12 text-2xl">book</div>
    <div class="w-full h-full bg-white pt-10 pl-5">
        <div class="w-full h-6 text-xl">Create</div>
        <section class="w-full h-full">
            <form action="" method="POST" class="w-3/5 mt-10">
                <label for="Username" class="w-[95%] mx-auto">
                    <span class="text-lg font-semibol font-sans">Username</span>
                    <input type="text" name="Username" id="Username" class="w-full h-10 bg-slate-100 rounded-full font-mono text-lg px-3 border-1">
                </label>
                <label for="Password" class="w-[95%] mx-auto">
                    <span class="text-lg font-semibol font-sans">Password</span>
                    <input type="text" name="Password" id="Password" class="w-full h-10 bg-slate-100 rounded-full font-mono text-lg px-3 border-1">
                </label>
                <label for="Role" class="w-[95%] mx-auto">
                    <span class="text-lg font-semibol font-sans">Role</span>
                    <select type="text" name="Role" id="Role" class="w-full h-10 bg-slate-100 rounded-full font-mono text-lg px-3 border-1">
                        <option value="admin">admin</option>
                        <option value="anggota">anggota</option>
                    </select>
                </label>
                <div class="gap-5 flex flex-row  mt-5">
                    <button type="submit" class="bg-green-500 hover:bg-green-700 outline-slate-500 outline-2 hover:outline-offset-2  rounded-full w-24 h-10 text-center">Add</button>
                    <button type="reset" @click="modal=!modal" class="bg-red-500 hover:bg-red-700 outline-slate-500 outline-2 hover:outline-offset-2 rounded-full w-24 h-10 text-center">cancel</button>
                </div>
            </form>
        </section>
    </div>
</section>

<?php section(null, 'admin') ?>