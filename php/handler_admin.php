<?php
require_once 'class_admin.php';

//U OVIM PETLJAMA PRAVIMO OBJEKTE I USMERAVAMO "POST" SA JQUERY-a NA PHP CLASS I TACNO ODREDJENU FUNKCIJU

if(isset($_POST['verifikacija_prikaz_profila_adminu']))
{
  $objekat = new class_admin();
  $rezultat = $objekat->prikaz_profila_adminu();
  exit(json_encode($rezultat));
}

if(isset($_POST['verifikacija_ispis_podataka_u_modal']))
{
  $objekat = new class_admin();
  $rezultat = $objekat->ispis_podataka_u_modal();
  exit(json_encode($rezultat));
}

if(isset($_POST['verifikacija_promena_podataka']))
{
  $objekat = new class_admin();
  $rezultat = $objekat->promena_podataka();
  exit(json_encode($rezultat));
}

if(isset($_POST['verifikacija_brisanja_profila']))
{
  $objekat = new class_admin();
  $rezultat = $objekat->brisanje_profila();
  exit(json_encode($rezultat));
}

if(isset($_POST['verifikacija_dodavanje_novog_profila']))
{
  $objekat = new class_admin();
  $rezultat = $objekat->dodavanje_novog_profila();
  exit(json_encode($rezultat));
}

if(isset($_POST['verifikacija_dodavanje_slike']))
{ //ova verifikacija se poziva direktno iz modala/forme za uploada slika i poslana je verifikaciju iz pomoc skrivenog inputa
  $objekat = new class_admin();     //redi bez jquery-a
  $rezultat = $objekat->dodavanje_slike();
  exit(json_encode($rezultat));
}

if(isset($_POST['verifikacija_odobri_komentare']))
{
  $objekat = new class_admin();
  $rezultat = $objekat->odobri_komentare();
  exit(json_encode($rezultat));
}

?>
