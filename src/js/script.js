$(document).ready(function(){

prikaz_profila_korisnika();

});

function prikaz_profila_korisnika()
{
    var verifikacija_prikaz_profila = 'verifikacija_prikaz_profila';
    $.post("php/handler.php",{
       verifikacija_prikaz_profila:verifikacija_prikaz_profila
     },function(data,status){
       var data = jQuery.parseJSON(data);
       var rezultat='';
           for(var i=0; i<data.length;i++)
           {

             if(data[i][3] == null || data[i][3] == "")
             {
              rezultat+="<abbr title='Pogledaj detaljinije'><div class='drzac_profila' onClick='otvori_profil("+data[i][0]+")'> <div class='div_slika'> <img src='slike_profila/photo.png' height='150px' width='180px' id='slika'></div> <div class='div_manji_opis'>"+data[i][1]+"</div> <div class='div_cena'>"+data[i][2]+"</div></div></abbr>";
             }
             else
             {
              rezultat+="<abbr title='Pogledaj detaljinije'><div class='drzac_profila' onClick='otvori_profil("+data[i][0]+")'> <div class='div_slika'> <img src='slike_profila/"+data[i][0]+"/"+data[i][3]+"' height='150px' width='180px' id='slika'></div> <div class='div_manji_opis'>"+data[i][1]+"</div> <div class='div_cena'>"+data[i][2]+"</div></div></abbr>";
             }
           }
             $("#centralni_div").html(rezultat);
    })
};

function otvori_profil(id_korisnika)
{                                              //OVOM FUNKCIJOM SE PREBACUJEMO NA STRANICU PROFILA I GET METODOM SALJEMO ID KORISNIKA
    window.location.href = 'delovi_sajta/profil_korisnika.php?id_korisnika='+id_korisnika;
}
