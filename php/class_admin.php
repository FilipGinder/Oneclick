<?php
class class_admin{
  function prikaz_profila_adminu()
 {
      include ('konekcija.php');
      $upit = "SELECT id_korisnika,duzi_opis,cena,naziv_slike FROM korisnici";
      $rezultat = $konekcija->prepare($upit);
      $rezultat->execute();
      $rezultat->bind_result($id_korisnika,$duzi_opis,$cena,$naziv_slike);       //ISPISUJEMO SVE PROFILE I SVE NJIHOVE PODATKE
      $rezultat_niz = array();
      while ($rezultat->fetch())
      {
       $rezultat_niz[]=array($id_korisnika,$duzi_opis,$cena,$naziv_slike);
      }
      $konekcija->close();
      exit(json_encode($rezultat_niz));
 }

 function ispis_podataka_u_modal()
{
     include ('konekcija.php');
     $id_korisnika = $_POST['id_korisnika'];
     $upit = "SELECT id_korisnika,duzi_opis,cena FROM korisnici WHERE id_korisnika = '$id_korisnika'";
     $rezultat = $konekcija->prepare($upit);
     $rezultat->execute();
     $rezultat->bind_result($id_korisnika,$duzi_opis,$cena);           //PODATKE ISPISUJEMO U MODAL ZA IZMENU PODATAKA
     $rezultat_niz = array();
     while ($rezultat->fetch())
     {
      $rezultat_niz[]=array($id_korisnika,$duzi_opis,$cena);
     }
     $konekcija->close();
     exit(json_encode($rezultat_niz));
}

function promena_podataka()
{
    include ('konekcija.php');
    $promenjena_cena = $_POST['promenjena_cena'];
    $promenjeni_opis = $_POST['promenjeni_opis'];
    $id_korisnika = $_POST['id_korisnika'];
    $upit = "UPDATE korisnici SET duzi_opis = '$promenjeni_opis', cena = '$promenjena_cena' WHERE id_korisnika = $id_korisnika";
    $rezultat = $konekcija->prepare($upit);
    $rezultat->execute();                             //MENJAMO PODATKE O PISU I CENI
    $konekcija->close();
    exit(json_encode('Uspesno promenjeni podaci'));
}

function brisanje_profila()
{
    $id_korisnika = $_POST['id_korisnika'];
    $dir = opendir("../slike_profila/$id_korisnika");      //OVO PRVO OTVARA FOLDER koji je uvek tu definisan
          while (($file = readdir($dir)) !== false)
          {                //OVO CITA STA SVE IMA U FOLDERU I PAKUJE TE INFORMACIJE U $file
             if($file > 0)
             {
                unlink("../slike_profila/$id_korisnika/".$file);      //ZATIM BRISE SVE U TOM FOLDERU TJ ONO STO JE NAVEDENO $file
             }
          }
          rmdir("../slike_profila/$id_korisnika");    //ZATIM BRISE FOLDER

    include ('konekcija.php');
    $upit = "DELETE FROM korisnici WHERE id_korisnika = '$id_korisnika'";      //BRISANJE PROFILA IZ BAZE
    $rezultat = $konekcija->prepare($upit);
    $rezultat->execute();
    $konekcija->close();
    exit(json_encode('Uspesno obrisan profil'));
}

function dodavanje_novog_profila()
{
   include ('konekcija.php');
   $nova_cena_unos = $_POST['nova_cena_unos'];
   $nov_opis_unos = $_POST['nov_opis_unos'];
   $upit="INSERT INTO korisnici(duzi_opis,cena) VALUES ('$nov_opis_unos','$nova_cena_unos')";
   $rezultat = $konekcija->prepare($upit);
   $rezultat->execute();
   $IDtog_novog_reda_u_bazi = mysqli_insert_id($konekcija);  //DODAVANJE NOVOG PROFILA
   $konekcija->close();
   mkdir("../slike_profila/$IDtog_novog_reda_u_bazi");  //kreira folder sa ID-em novog profila u koji ce se skladistiti njegova slika
   exit(json_encode('Uspesno kreiran profil'));
}

function dodavanje_slike()
{
    include ('konekcija.php');
    $id_korisnika = $_POST['verifikacija_dodavanje_slike'];
    $upit = "SELECT naziv_slike FROM korisnici WHERE id_korisnika = $id_korisnika";
    $rezultat = $konekcija->prepare($upit);
    $rezultat->execute();
    $rezultat->bind_result($slika);
    $rezultat->fetch();
    $konekcija->close();

    $directory = "../slike_profila/$id_korisnika/";   //putanja do foldera
    $filecount = 0;
    $files = glob($directory . "*");
    if ($files)
    {
     $filecount = count($files);  //prebrojava sve u folderu i u ovu variablu pakuje broj koliko ima slika,fajlova
    }


if($filecount == 0)    //AKO JE BROJ SLIKA/FAJLOVA NULA ONDA DOPUSTA NOV UNOS SLIKE
{
                              $file = $_FILES['file']; //ovako je "file je po default-u u dropzoni"
                              $fileIME = $_FILES['file']['name'];
                              $fileLokacija = $_FILES['file']['tmp_name'];
                              $fileVelicina = $_FILES['file']['size'];
                              $fileGreska = $_FILES['file']['error'];
                              $fileTip = $_FILES['file']['type'];

                              $filedeljenje = explode('.',$fileIME);
                              $filemalaslova = strtolower(end($filedeljenje));

                              $formati = array('jpg', 'jpeg', 'png');
                              if (in_array($filemalaslova,$formati))
                              {
                                            $novoime = uniqid('', true).".".$filemalaslova;
                                            $odrediste = "../slike_profila/$id_korisnika/".$novoime;    //OVDE JE DEFINISANA PUTANJA KA FOLDERU KORISNIKA POD NJEGOVIM
                                            move_uploaded_file($fileLokacija,$odrediste);       //IMENOM

                                          		       //UPLOAD U BAZU
                                                    include ('konekcija.php');
                                                    $upit="UPDATE korisnici SET naziv_slike = '$novoime' WHERE id_korisnika = $id_korisnika";
                                                    $rezultat=$konekcija->prepare($upit);
                                                    $rezultat->execute();                     //OBAVEZNO JE ZATVORITI PRVU KONEKCIJU I OTVORITI DRUGU
                                                    $konekcija->close();
                                                    exit(json_encode("uspesno ste promenili svoj logo"));
                                          	       //UPLOAD U BAZU
                              }
                             else
                             {
                               exit(json_encode("Format tog tipa nije podrzan"));
                             }
}
else if($filecount == 1)  //AKO JE BROJ SLIKA/FAJLOVA JEDAN ONDA PRVO BRISE STARU SLIKU IZ BAZE PA TEK ONDA DOPUSTA NOVI UNOS SLIKE
 {
                           unlink("../slike_profila/$id_korisnika/".$slika);  //PRVO BRISE POSTOJECU SLIKU

                           $file = $_FILES['file'];                        //a zatim unosi novu
                           $fileIME = $_FILES['file']['name'];
                           $fileLokacija = $_FILES['file']['tmp_name'];
                           $fileVelicina = $_FILES['file']['size'];
                           $fileGreska = $_FILES['file']['error'];
                           $fileTip = $_FILES['file']['type'];

                           $filedeljenje = explode('.',$fileIME);
                           $filemalaslova = strtolower(end($filedeljenje));

                           $formati = array('jpg', 'jpeg', 'png');
                           if (in_array($filemalaslova,$formati))
                           {
                                              $novoime = uniqid('', true).".".$filemalaslova;
                                              $odrediste = "../slike_profila/$id_korisnika/".$novoime;    //OVDE JE DEFINISANA PUTANJA KA FOLDERU PROFILA POD NJEGOVIM
                                              move_uploaded_file($fileLokacija,$odrediste);       //IMENOM

                                          		       //UPLOAD U BAZU
                                                    include ('konekcija.php');
                                                    $upit="UPDATE korisnici SET naziv_slike = '$novoime' WHERE id_korisnika = $id_korisnika";
                                                    $rezultat=$konekcija->prepare($upit);
                                                    $rezultat->execute();
                                                    $konekcija->close();
                                                    exit(json_encode("uspesno ste promenili svoj logo"));
                                         		        //UPLOAD U BAZU
                           }
                           else
                           {
                             exit(json_encode("Format tog tipa nije podrzan"));
                           }
}
else if($filecount > 1)  //AKO JE BROJ SLIKA/FAJLOVA VECI OD JEDAN (sto ne bi trebalo nikad da bude) ONDA JAVLJA GRESKU ERROR
{
      exit(json_encode("ERROR"));
}
}

function odobri_komentare()
 {
     include ('konekcija.php');
     $dugme_odobri_komentare = $_POST['dugme_odobri_komentare'];
     $upit = "UPDATE komentari SET odobrenje_komentara = 'odobren' WHERE id_korisnika = $dugme_odobri_komentare";
     $rezultat = $konekcija->prepare($upit);
     $rezultat->execute();                              //OVIM ODOBRAVAMO KOMENTAR TJ MENJAMO MU STATUS IZ CEKA ODOBRENJE U ODOBREN
     $konekcija->close();
     exit(json_encode('Komentari uspesno odobreni'));
 }

} //zatvaranje classe















 ?>
