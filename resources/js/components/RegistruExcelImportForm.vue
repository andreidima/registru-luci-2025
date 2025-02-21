<template>
  <form @submit.prevent="handleSubmit" class="needs-validation" method="POST" action="/registru/import" enctype="multipart/form-data">
    <!-- CSRF token, you might output this via Blade -->
    <input type="hidden" name="_token" :value="csrfToken">
        <div class="modal-body" style="text-align:left;">
            Încarcă un fișier excel de importat în baza de date.
            <br>
            Primul rând va fi automat ignorat, așa că <span class="text-danger">NU</span> șterge capul de tabel înainte de încărcare.
            <br><br>
            Coloanele trebuie să fie în ordinea următoare:
            <ul>
                <li class="" style="line-height:100%;">DATA</li>
                <li class="" style="line-height:100%;">Sector cadastral</li>
                <li class="" style="line-height:100%;">NUMAR CAD GEN / Identificator teren</li>
                <li class="" style="line-height:100%;">UAT</li>
                <li class="" style="line-height:100%;">Nr. tarla</li>
                <li class="" style="line-height:100%;">Nr.parcela</li>
                <li class="" style="line-height:100%;">Suprafata masurata Anexa 4</li>
                <li class="" style="line-height:100%;">NUME COMPLET</li>
                <li class="" style="line-height:100%;">Nume/ Denumire</li>
                <li class="" style="line-height:100%;">Initiala tatalui</li>
                <li class="" style="line-height:100%;">Prenume</li>
                <li class="" style="line-height:100%;">CNP</li>
                <li class="" style="line-height:100%;">ACT/DATA</li>
                <li class="" style="line-height:100%;">OBS</li>
                <li class="" style="line-height:100%;">NC</li>
                <li class="" style="line-height:100%;">CF</li>
                <li class="" style="line-height:100%;">Intravilan/extravilan (I/E)</li>
                <li class="" style="line-height:100%;">Categorie folosinta</li>
                <li class="" style="line-height:100%;">Domiciliu/Sediu</li>
                <li class="" style="line-height:100%;">Mod de dobandire</li>
                <li class="" style="line-height:100%;">Tip act</li>
                <li class="" style="line-height:100%;">Emitent</li>
                <li class="" style="line-height:100%;">DATA NASTERE.</li>
            </ul>
            <div class="form-group">
                <label for="fisier_excel">Alege fișierul excel:</label>
                <br>
                <input type="file" name="fisier_excel" class="form-control" required>
                <div class="invalid-feedback">Alege un fișier excel.</div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Renunță</button>

            <button type="submit" :disabled="isSubmitting" class="btn btn-success text-white">
                <span v-if="isSubmitting">Se importă datele în baza de date...</span>
                <span v-else>Importă fișierul excel</span>
            </button>
        </div>
    </form>
</template>

<script>
export default {
  data() {
    return {
      isSubmitting: false,
      csrfToken: document.querySelector('meta[name="csrf-token"]').getAttribute('content')
    }
  },
  methods: {
    handleSubmit(event) {
      this.isSubmitting = true;
      // Use $refs or simply submit the form if not doing AJAX:
      event.target.submit();
    }
  }
}
</script>
