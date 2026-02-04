<?php
$curents = $_SERVER['REQUEST_URI'];
$mboh=explode("/",$curents);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?= $title ?></title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.7.2/css/all.min.css" />
</head>



<body class="bg-stone-200 w-screen h-screen overflow-x-hidden " x-data="{sidebar:false ,login:<?= isset($_SESSION['login']) ? ($_SESSION['login'] == true ? true : false) : false ?>}">
    <header class="w-full h-16 bg-blue-500 flex flex-row justify-between z-2" x-show="login">
        <div class="w-52">
            <button class="flex flex-col justify-center items-center h-full w-24" @click="sidebar=!sidebar"><i class="fa fa-solid fa-bars text-3xl text-center font-bold"></i></button>
        </div>
        <nav class="w-52 flex flex-row justify-center  items-center" x-data="{action:false}">
            <button class="w-20 h-10 outline-2 rounded-md bg-slate-300" @click="action=!action">Action</button>
            <div x-show="action" class="fixed top-16 bg-blue-500 w-34 p-1 gap-1 border-b-3 border-l-3 border-r-3 border-stone-500 z-1 rounded-b-sm"
                x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="translate-x-full"
                x-transition:enter-end="-traslate-x-0"
                x-transition:leave="transition ease-in duration-300"
                x-transition:leave-start="translate-x-0"
                x-transition:leave-end="translate-x-full">
                <a href="../login-back/logout.php"><button class="hover:bg-slate-100 w-full rounded-sm">logouts</button></a>
            </div>

        </nav>
    </header>

    </section>


    <main class="flex flex-row  w-full min-h-screen overflow-x-auto">
        <aside id="sidebar" class="w-64 bg-blue-400/90 mt-2 h-screen sticky top-0 flex-shrink-0 flex flex-col gap-y-1 px-2 max-md:fixed max-md:top-14" x-show="sidebar && login"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="-translate-x-full"
            x-transition:enter-end="translate-x-0"
            x-transition:leave="transition ease-in duration-300"
            x-transition:leave-start="translate-x-0"
            x-transition:leave-end="-translate-x-full">
            <div class="p-4 text-white font-bold">Sidebar Menu</div>

            <a class="w-full h-12 hover:bg-sky-500  border-y-2 border-black" href="../dashboard/"> Dashboard</a>

            <?php if ($_SESSION['role'] == 'admin'): ?>
                <a class="w-full h-12 hover:bg-sky-500  border-y-2 border-black" href="../buku"> Book</a>
                <a class="w-full h-12 hover:bg-sky-500  border-y-2 border-black" href="../user"> User</a>
                <a class="w-full h-12 hover:bg-sky-500  border-y-2 border-black" href="../transaction"> Transaction</a>
            <?php endif ?>

            <?php if ($_SESSION['role'] == 'anggota'): ?>
                <a class="w-full h-12 hover:bg-sky-500  border-y-2 border-black" href="../form/pinjam.php"> pinjam</a>
                <a class="w-full h-12 hover:bg-sky-500  border-y-2 border-black" href="../form/kembali.php"> kembali</a>
                <a class="w-full h-12 hover:bg-sky-500  border-y-2 border-black" href="../history"> History</a>
            <?php endif ?>
        </aside>

        <?php echo $content ?>

    </main>
</body>

</html>