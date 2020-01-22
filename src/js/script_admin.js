$(document).ready(function(){

    prikaz_profila_korisnika_na_admin_stranici();
    obrisi_profil();
    dodaj_novi_profil();
    odobri_komentare();
    ponovno_ucitavanje_profila_posle_promene_slike();

});
function prikaz_profila_korisnika_na_admin_stranici()
{
    var verifikacija_prikaz_profila_adminu = 'verifikacija_prikaz_profila_adminu';
    $.post("php/handler_admin.php",{
       verifikacija_prikaz_profila_adminu:verifikacija_prikaz_profila_adminu
     },function(data,status){
       var data = jQuery.parseJSON(data);
       var rezultat='';
       var slika='';
           for(var i=0; i<data.length;i++)
           {
             if(data[i][3] == null || data[i][3] == "")
             {
               rezultat+="<div class='drzac_profila_admin'><div class='div_slika_admin' onClick='promena_slike("+data[i][0]+")'> <abbr title='Klikni za promenu profilne slike'> <div class='same_slike'><img src='slike_profila/photo.png' height='200px' width='278px' id='slika'></div></abbr></div><div class='div_manji_opis_admin'>"+data[i][1]+"</div><div class='div_cena_admin'>"+data[i][2]+"</div><input data-toggle='modal' data-target='#exampleModal' data-whatever='@mdo' onClick='izmeni_profil("+data[i][0]+")' id='prikazi_profil' value='Izmeniti' class='btn btn-danger' type='button'></div>";     //OPCIJA JEDAN CIM SE NAPRAVI NOVI PROFIL ODMAH UCITA GENERISANU FOTOGRAFIJU
             }
             else
               {
                 rezultat+="<div class='drzac_profila_admin'><div class='div_slika_admin' onClick='promena_slike("+data[i][0]+")'> <abbr title='Klikni za promenu profilne slike'> <div class='same_slike'><img src='slike_profila/"+data[i][0]+"/"+data[i][3]+"' height='200px' width='278px' id='slika'></div></abbr></div><div class='div_manji_opis_admin'>"+data[i][1]+"</div><div class='div_cena_admin'>"+data[i][2]+"</div><input data-toggle='modal' data-target='#exampleModal' data-whatever='@mdo' onClick='izmeni_profil("+data[i][0]+")' id='prikazi_profil' value='Izmeniti' class='btn btn-danger' type='button'></div>";  //OPCIJA DVA, AKO POSTOJI PROFILNA FOTOGRAFIJA ONDA UCITAVA NJU
               }
            }
            $("#centralni_div_admin").html(rezultat);
           }
      )
}

function izmeni_profil(id_korisnika)
{
//OVIM OTVARAMO MODAL I ODMAH U NJEMU ISPISUJEMO PODATKE I DUGMICIMA DODELJUJEMO VREDNOSTI ID-eva
//Prvo ispisujemo stare rezultate o profilu u modal
        var verifikacija_ispis_podataka_u_modal = 'verifikacija_ispis_podataka_u_modal';
        $.post("php/handler_admin.php",{
           verifikacija_ispis_podataka_u_modal:verifikacija_ispis_podataka_u_modal,
           id_korisnika:id_korisnika
         },function(data,status){
           var data = jQuery.parseJSON(data);
           var cena='';
           var opis='';
           var id_korisnika ='';
               for(var i=0; i<data.length;i++)
               {
                cena+= data[i][2];
                opis+= data[i][1];
                id_korisnika+= data[i][0];
               }

                 $("#recipient-name").val(cena).css("color","red");
                 $("#message-text").val(opis).css("color","red");
                 $("#odobri_komentare").val(id_korisnika);
                 $("#promeni_podatke").val(id_korisnika);
                 $("#obrisi_profil").val(id_korisnika);   //ovim dugmetu obrisi profil dodeljujemo vrednost ID-a, da bi znali koga brisemo
        })                                               //svakim otvaranjem modala dugme dobija iznova vrednost ID-a tog korisnika

//Prvo ispisujemo stare rezultate o profilu u modal

//Zatim menjamo podatke
          $("#promeni_podatke").click(function(){
              var verifikacija_promena_podataka = 'verifikacija_promena_podataka';
              var promenjena_cena = $("#recipient-name").val();
              var promenjeni_opis = $("#message-text").val();
              var id_korisnika = $("#promeni_podatke").val();

              $.post("php/handler_admin.php",{
                 verifikacija_promena_podataka:verifikacija_promena_podataka,
                 promenjena_cena:promenjena_cena,
                 promenjeni_opis:promenjeni_opis,
                 id_korisnika:id_korisnika
               },function(data,status){
                 var data = jQuery.parseJSON(data);

                 if(data == "Uspesno promenjeni podaci")
                 {
                //   alert('Uspesno promenjeni podaci');
                    $('#exampleModal').modal('toggle');  //zatvaranje modala
                    $("#recipient-name").val('');  //brisanje vrednosti inputa
                    $("#message-text").val('');
                    prikaz_profila_korisnika_na_admin_stranici();  //ponovo pozivamo funkciju za prikaz profila koja se prvi put ucitava sa samom stranicom
                 }
                 else
                   {
                     alert('Doslo je do greske');
                   }
              })
          });
//Zatim menjamo podatke
}

function obrisi_profil()
{
    $("#obrisi_profil").click(function(){   //ovo dugme je samim otvaranjem modala dobilo vrednost ID-a zeljenog korisnika
                var id_korisnika = $("#obrisi_profil").val();
                var verifikacija_brisanja_profila = 'verifikacija_brisanja_profila';

                $.post("php/handler_admin.php",{
                   verifikacija_brisanja_profila:verifikacija_brisanja_profila,
                   id_korisnika:id_korisnika
                 },function(data,status){
                   var data = jQuery.parseJSON(data);

                       if(data == "Uspesno obrisan profil")
                       {
                         alert('Uspesno obrisan profil');
                         prikaz_profila_korisnika_na_admin_stranici();  //ponovo pozivamo funkciju za prikaz profila koja se prvi put ucitava sa samom stranicom
                       }
                       else
                         {
                           alert('Doslo je do greske');
                         }
            })
    })
}

function dodaj_novi_profil()
{
    $("#sacuvaj_novi_profil").click(function(){

       var verifikacija_dodavanje_novog_profila = 'verifikacija_dodavanje_novog_profila';
       var nova_cena_unos = $("#novi_profil_cena").val();
       var nov_opis_unos = $("#novi_profil_opis").val();
       var dodavanje_slike = $('#dodavanje_slike').val();

      if(nova_cena_unos == "" || nova_cena_unos == null || nov_opis_unos == "" || nov_opis_unos == null)
      {
        alert('Popunite prazna polja');
        $('#dodaj_novi_profil_modal').modal('toggle');
        return;
      }
      else
      {
        $.post("php/handler_admin.php",{
           verifikacija_dodavanje_novog_profila:verifikacija_dodavanje_novog_profila,
           nova_cena_unos:nova_cena_unos,
           nov_opis_unos:nov_opis_unos,
           dodavanje_slike:dodavanje_slike
         },function(data,status){
           var data = jQuery.parseJSON(data);

           if(data == "Uspesno kreiran profil")
           {
             alert('Uspesno kreiran profil');
             $('#dodaj_novi_profil_modal').modal('toggle');  //zatvaranje modala
             $("#novi_profil_cena").val('');  //brisanje vrednosti inputa
             $("#novi_profil_opis").val('');
             prikaz_profila_korisnika_na_admin_stranici();  //ponovo pozivamo funkciju za prikaz profila koja se prvi put ucitava sa samom stranicom
           }
           else
             {
               alert('Doslo je do greske');
             }
        })
      }
   });
}

function promena_slike(id_korisnika)
{
      $('#ceo_modal_promena_slike').modal('toggle');   //otvara modal
      $("[name='verifikacija_dodavanje_slike']").val(id_korisnika); //ovim, skrivenom inputu u dropzone formi dodeljujemo vrednost izabranog korisnika kome treba
      Dropzone.forElement('#forma_za_upload_slike').removeAllFiles(true);     //promeniti sliku i tim inputom dalje POST-om saljemo tu vrednost u php da bi se na ospvu njega
                                                                  //promenila slika tom izabranom profilu
}

function odobri_komentare()
{
  $("#odobri_komentare").click(function(){
            var dugme_odobri_komentare = $("#odobri_komentare").val();
            var verifikacija_odobri_komentare = "verifikacija_odobri_komentare";

            $.post("php/handler_admin.php",{
                     verifikacija_odobri_komentare:verifikacija_odobri_komentare,
                     dugme_odobri_komentare:dugme_odobri_komentare
                   },function(data,status){
                     var data = jQuery.parseJSON(data);

                           if(data == "Komentari uspesno odobreni")
                           {
                             alert('Komentari uspesno odobreni');
                           }
                           else
                           {
                             alert('Doslo je do greske');
                           }
                  })

         });
}

//kad zatvorimo modal posle promene slike ponovo ucitavamo sve profilne podatke (reload)
function ponovno_ucitavanje_profila_posle_promene_slike()
{
  $("#sacuvaj_novi_logo").click(function(){
    prikaz_profila_korisnika_na_admin_stranici();
  });
}
