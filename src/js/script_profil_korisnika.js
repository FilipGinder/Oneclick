$(document).ready(function(){

    id_korisnika = window.location.search.substring(14);   //globalna variabla na koju se dalje u kodu stalno pozivamo
    nazad_na_pocetnu();
    prikaz_profila_korisnika();
    prikaz_komentara();

})
function prikaz_komentara()
{
  var verifikacija_prikaz_komentara = 'verifikacija_prikaz_komentara';
  $.post("../php/handler_profil_korisnika.php",{
     verifikacija_prikaz_komentara:verifikacija_prikaz_komentara,
     id_korisnika:id_korisnika
   },function(data,status){
     var data = jQuery.parseJSON(data);
     var rezultat='';
         for(var i=0; i<data.length;i++)
         {
             rezultat+="<div class='komentari'>"+data[i][0]+"</div>";
         }
           $("#div_sa_komentarima").prepend(rezultat);
    })
}
function nazad_na_pocetnu()
{
    $("#nazad").click(function(){
      window.location.href = '../index.php';
    })
}
function prikaz_profila_korisnika()
{
    var verifikacija_prikaz_profila_na_profilnoj = 'verifikacija_prikaz_profila_na_profilnoj';
    $.post("../php/handler_profil_korisnika.php",{
       verifikacija_prikaz_profila_na_profilnoj:verifikacija_prikaz_profila_na_profilnoj,
       id_korisnika:id_korisnika
     },function(data,status){
       var data = jQuery.parseJSON(data);
       var rezultat='';
           for(var i=0; i<data.length;i++)
           {
            if(data[i][2] == null || data[i][2] == "")
            {
               rezultat+="<div class='drzac_profila'><div class='div_slika'>   <img src='../slike_profila/photo.png' height='600px' width='100%' id='slika_profilna_velika'>   </div><div class='div_manji_opis'><h4>Unesite komentar</h4><textarea rows='4' cols='30' id='komentar' placeholder='Unesite komentar'></textarea><br><br><input type='button' class='btn btn-danger' value='Posalji' id='posalji_komentar_dugme' onClick='poslati_komentar()'></div><div class='div_veci_opis'><h4>Opis copywritera</h4>"+data[i][0]+"</div><div class='div_cena'><h4>Cena</h4>"+data[i][1]+"</div></div>";
            }
            else
            {
              rezultat+="<div class='drzac_profila'><div class='div_slika'>   <img src='../slike_profila/"+data[i][3]+"/"+data[i][2]+"' height='600px' width='100%' id='slika_profilna_velika'>    </div><div class='div_manji_opis'><h4>Unesite komentar</h4><textarea rows='4' cols='30' id='komentar' placeholder='Unesite komentar'></textarea><br><br><input type='button' class='btn btn-danger' value='Posalji' id='posalji_komentar_dugme' onClick='poslati_komentar()'></div><div class='div_veci_opis'><h4>Opis copywritera</h4>"+data[i][0]+"</div><div class='div_cena'><h4>Cena</h4>"+data[i][1]+"</div></div>";
            }
         }
             $("#centralni_div_profila").html(rezultat);
    })
};

function poslati_komentar()
{
          if($("#komentar").val() == "" || $("#komentar").val() == null)
          {
            return;
          }
          else
          {
                var verifikacija_unosa_komentara = 'verifikacija_unosa_komentara';
                var komentar = $("#komentar").val();

                $.post("../php/handler_profil_korisnika.php",{
                   verifikacija_unosa_komentara:verifikacija_unosa_komentara,
                   id_korisnika:id_korisnika,
                   komentar:komentar
                 },function(data,status){
                   var data = jQuery.parseJSON(data);

                        if(data == "ceka odobrenje")
                        {
                          alert('Vas komentar ce biti prikazan posle odobrenja administratora');
                          $("#komentar").val('');
                        }
                        else
                        {
                          alert('Doslo je do greske prilikom unosa komentara');
                        }
                })
          }
}
