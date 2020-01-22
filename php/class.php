<?php
class glavna_class{
  function prikaz_profila()
 {
      include ('konekcija.php');

      $upit = "SELECT id_korisnika, SUBSTRING(duzi_opis, 1, 10) AS ExtractString, cena,naziv_slike FROM korisnici";
      $rezultat = $konekcija->prepare($upit);   //uz pomoce query-a i opcije 'SUBSTRING(primer_bilo koje kolone, 1, 3) AS ExtractString' ...cecemo srting odmah u bazi
      $rezultat->execute();
      $rezultat->bind_result($id_korisnika,$duzi_opis,$cena,$naziv_slike);

      $rezultat_niz = array();

      while ($rezultat->fetch())                    //ISPISUJEMO PODATKE O SVIM PROFILIMA NA INDEX.PHP SA SKRACENIM OPISOM OSOBE
      {
       $rezultat_niz[]=array($id_korisnika,$duzi_opis,$cena,$naziv_slike);
      }
      $konekcija->close();
          exit(json_encode($rezultat_niz));
 }


}
 ?>
