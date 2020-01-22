<?php
require_once 'class_profil_korisnika.php';

//U OVIM PETLJAMA PRAVIMO OBJEKTE I USMERAVAMO "POST" SA JQUERY-a NA PHP CLASS I TACNO ODREDJENU FUNKCIJU

if(isset($_POST['verifikacija_prikaz_profila_na_profilnoj']))
{
  $objekat = new class_profil_korisnika();
  $rezultat = $objekat->prikaz_profil_korisnika();
  exit(json_encode($rezultat));
}

if(isset($_POST['verifikacija_prikaz_komentara']))
{
  $objekat = new class_profil_korisnika();
  $rezultat = $objekat->prikaz_komentara();
  exit(json_encode($rezultat));
}

if(isset($_POST['verifikacija_unosa_komentara']))
{
  $objekat = new class_profil_korisnika();
  $rezultat = $objekat->unos_komentara();
  exit(json_encode($rezultat));
}


?>
