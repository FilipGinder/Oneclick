<?php
class class_profil_korisnika{
  function prikaz_profil_korisnika()
 {
      include ('konekcija.php');
      $id_korisnik = $_POST['id_korisnika'];
      $upit = "SELECT duzi_opis,cena,naziv_slike,id_korisnika FROM korisnici WHERE id_korisnika = '$id_korisnik'";
      $rezultat = $konekcija->prepare($upit);
      $rezultat->execute();
      $rezultat->bind_result($duzi_opis,$cena,$naziv_slike,$id_korisnika); //IZLISTAVAMO SVE PODATKE O PROFILU
      $rezultat_niz = array();
      while ($rezultat->fetch())
      {
       $rezultat_niz[]=array($duzi_opis,$cena,$naziv_slike,$id_korisnika);
      }
      $konekcija->close();
      exit(json_encode($rezultat_niz));
 }


 function prikaz_komentara()
{
     include ('konekcija.php');
     $id_korisnik = $_POST['id_korisnika'];
     $upit = "SELECT komentar FROM komentari WHERE id_korisnika = '$id_korisnik' AND odobrenje_komentara = 'odobren'";
     $rezultat = $konekcija->prepare($upit);
     $rezultat->execute();
     $rezultat->bind_result($komentar);      //PRIKAZUJEMO SVE ODOBRENE KOMENTARE PORED PROFILA
     $rezultat_niz = array();
     while ($rezultat->fetch())
     {
      $rezultat_niz[]=array($komentar);
     }
     $konekcija->close();
     exit(json_encode($rezultat_niz));
}


 function unos_komentara()
 {
      include ('konekcija.php');
      $id_korisnik = $_POST['id_korisnika'];
      $komentar = $_POST['komentar'];
      $upit="INSERT INTO komentari(id_korisnika,komentar,odobrenje_komentara) VALUES('$id_korisnik','$komentar','ceka odobrenje')";
      $rezultat = $konekcija->prepare($upit);
      $rezultat->execute();
      $konekcija->close();                      //UNOSIMO NOVI KOMENTAR U BAZU
      exit(json_encode('ceka odobrenje'));
 }
}
?>
