<?php include_once(dirname(__DIR__, 2) . '/config.php');
startsect ?>


<?php
include_once(dirname(__DIR__, 2) . '/database/db-con.php');


?>

<section class="flex-1 w-full  sm:pl-8 " x-data="{editform:'',modal:false}">
    <div class="w-full h-12 text-2xl">Dashboard</div>
    <div class="w-full h-full bg-white pt-10 pl-5 font-sans flex flex-1 gap-5">

        <!-- <a href="../user/" class="bg-yellow-400 w-70 h-30 rounded-lg p-2 flex flex-col">
            <h1 class="text-xl font-semibold">User</h1>
            <li class="ml-5 mt-4"><?= $user['COUNT(*)'] ?></li>

        </a> -->


    </div>
</section>

<?php section(null, 'anggota') ?>