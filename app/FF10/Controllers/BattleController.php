<?php 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if($_POST["action"]=="Attack") {
        $cloud->attack($sephiroth);
        $attackNote= "You attacked Sephiroth";
        $hpUpdate= echo $sephiroth->getHp();
    }
}