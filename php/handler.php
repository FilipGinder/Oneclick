<?php
require_once 'class.php';

//U OVOM PETLJAM PRAVIMO OBJEKAT I USMERAVAMO "POST" SA JQUERY-a NA PHP CLASS I TACNO ODREDJENU FUNKCIJU

if(isset($_POST['verifikacija_prikaz_profila']))
{
  $objekat = new glavna_class();
  $rezultat = $objekat->prikaz_profila();
  exit(json_encode($rezultat));
}
?>
