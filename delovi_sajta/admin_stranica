<div class="container">
  <div class="row">
    <div class="col-md-12">
      <h1 id="naslov_admin">Admin stranica</h1>
      <input type="button" class="btn btn-success" data-toggle="modal" data-target="#dodaj_novi_profil_modal" data-whatever="@mdo" value="Dodaj novi profil" id="dodaj_novi_profil">
    </div>
  </div>
  <div class="row">
    <div class="col-md-1">

    </div>
    <div id="centralni_div_admin" class="col-md-10">

    </div>
    <div class="col-md-1">

    </div>
  </div>
</div>


<!-- MODAL KOJI POZIVAMO KAD KLIKNEMO NA PROFIL NA ADMIN STRANICI KAD TREBA DA PROMENIMO PODATKE -->

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Izmena podataka</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
                      <div class="modal-body">
                         <form>
                              <div class="form-group">
                                <label for="recipient-name" class="col-form-label">Cena:</label>
                                <input type="text" class="form-control" id="recipient-name">
                              </div>
                                      <div class="form-group">
                                        <label for="message-text" class="col-form-label">Opis profila:</label>
                                        <textarea class="form-control" id="message-text"></textarea>
                                      </div>
                         </form>
                      </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal" id="odobri_komentare">Odobri komentare</button>
              <button type="button" class="btn btn-secondary" data-dismiss="modal" id="obrisi_profil">Obrisi korisnika</button>
              <button type="button" class="btn btn-primary" id="promeni_podatke">Promeni</button>
            </div>
    </div>
  </div>
</div>
<!-- MODAL KOJI POZIVAMO KAD TREBA DA PROMENIMO PODATKE -->

<!-- MODAL KOJI POZIVAMO KAD TREBA DA UBACIMO NOVOG KORISNIKA -->

<div class="modal fade" id="dodaj_novi_profil_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Dodavanje novog profila</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="forma">
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Cena:</label>
            <input type="text" class="form-control" id="novi_profil_cena">
          </div>
          <div class="form-group">
            <label for="message-text" class="col-form-label">Opis:</label>
            <textarea class="form-control" id="novi_profil_opis"></textarea>
          </div>
        </form>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Zatvori</button>
        <button type="button" class="btn btn-primary" id="sacuvaj_novi_profil">Sacuvaj novi profil</button>
      </div>
    </div>
  </div>
</div>
<!-- MODAL KOJI POZIVAMO KAD TREBA DA UBACIMO NOVOG KORISNIKA -->

<!-- Modal Promena slike-->
<div class="modal fade" id="ceo_modal_promena_slike" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content" id="samo_modal_promena_logoa">
      <div class="modal-header">
        <h5 class="modal-title" id="naslov_modala_za_logo">Dodati ili promeniti sliku klikom ili prevlacenjem</h5>
        <button type="button" class="close" data-dismiss="modal" id="zatvori_modal_dodavanje_slike" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <!-- odavde se dodaju slike -->
      <div class="modal-body">
        <form action="php/handler_admin.php" method="post" class="dropzone" id="forma_za_upload_slike">
                 <input type="hidden" name="verifikacija_dodavanje_slike">
      </form>
      </div>
      <!-- odavde se dodaju slike -->
      
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" id="sacuvaj_novi_logo" data-dismiss="modal">Sacuvaj</button>
      </div>
    </div>
  </div>
</div>
