<?php include_once('config.php');
startsect ?>
<div class="w-full h-screen flex flex-row justify-center items-center">
    <section class="w-[450px] h-[500px] bg-sky-500/60 rounded-2xl ">
        <form action="<?= trim($curent_url,'login.php').'login-back/login.php' ?>" method="POST" class="flex flex-col items-center h-full w-full gap-5 ">
            <label class="h-18 w-full text-3xl flex flex-col justify-center font-bold gont-sans justify-center items-center ">Login</label>

            <label for="Username" class="w-[95%] mx-auto">
                <span class="text-lg font-semibol font-sans">Username</span>
                <input type="text" name="Username" id="Usename" class="w-full h-10 bg-slate-100 rounded-full font-mono text-lg px-3">
            </label>

            <label for="Password" class="w-[95%] mx-auto">
                <span class="text-lg font-semibol font-sans">Password</span>
                <input type="text" name="Password" id="Password" class="w-full h-10 bg-slate-100 rounded-full font-mono text-lg px-3">
            </label>

            <label for="register" class="w-full flex flex-col items-start p-2">
                <span>Belum punya akun?</span>
                <a href="register.php" name="register" id="register" class="text-blue-500 "> Register -> </a>
            </label>

            <button class="bg-green-400 rounded-full w-30 h-12 outline-2 outline-slate-300 hover:outline-offset-3 text-white text-outline hover:text-black font-bold font-sans text-2xl">Login</button>
        </form>
    </section>

    <div class="fixed top-5 left-5 bg-sky-300 w-64 h-24 p-1">
        <h1 class="text-lg font-mono font-semibold">
            Default admin: 
            <br>
            Username : rahmat
            Password : 1234
        </h1>

    </div>
</div>
<?php section() ?>