@extends ('layouts.app')

@section('content')
<div class="container mx-auto px-3 card" style="border-radius: 40px 40px 40px 40px;">
        <div class="row card-header align-items-center" style="border-radius: 40px 40px 0px 0px;">
            <div class="col-lg-6">
                <span class="badge culoare1 fs-5">
                    <i class="fa-solid fa-list"></i> Registrul cadastral al imobilelor
                </span>
            </div>
            <div class="col-lg-6 text-end">
                <a href="#"
                    class="mb-1 btn btn-sm btn-success text-white border border-dark rounded-3"
                    data-bs-toggle="modal"
                    data-bs-target="#importaExcel"
                    title="Importă date în Registrul Cadastral al Imobilelor"
                    >
                    <i class="fas fa-plus-square text-white me-1"></i>Importă excel
                </a>

                <br>

                <a href="#"
                    class="btn btn-sm btn-danger text-white border border-dark rounded-3"
                    data-bs-toggle="modal"
                    data-bs-target="#stergeBazaDeDate"
                    title="Șterge baza de date"
                    >
                    <i class="far fa-trash-alt text-white me-1"></i>Șterge baza de date</a>
            </div>
        </div>

        <div class="card-body px-0 py-3">

            @include ('errors.errors')

            <div class="row">
                <div class="col-lg-6">
                    <h3>
                        Registrul cadastral al imobilelor
                    </h3>

                    @foreach ($registru->groupBy('B') as $registru_grupat_sector)
                        Sector {{ $registru_grupat_sector->first()->B }} - {{ $registru_grupat_sector->count() }} înregistrări -
                        <a href="registru/export/registrul-cadastral-al-imobilelor/{{ $registru_grupat_sector->first()->B }}/export-html" target="_blank">
                            Vizualizare html
                        </a>
                        {{-- -
                        <a href="registru/export/registrul-cadastral-al-imobilelor/{{ $registru_grupat_sector->first()->B }}/export-pdf" target="_blank">
                            export pdf
                        </a> --}}
                        <br>
                        <div class="col-lg-12">
                            Salvare PDF - Pagini:
                            @foreach($registru_grupat_sector->groupBy('C')->chunk(100) as $groupValue => $chunks)
                                <a href="registru/export/registrul-cadastral-al-imobilelor/{{ $registru_grupat_sector->first()->B }}/export-pdf/{{ $chunks->first()->first()->id }}/{{ $chunks->last()->last()->id }}" target="_blank">
                                {{ $start = $loop->index * 100 + 1 }} - {{ $start + count($chunks) - 1 }}
                                </a>
                                @if (!$loop->last)
                                    /
                                @endif
                            @endforeach
                        </div>

                        <br><br>
                    @endforeach
                </div>

                <div class="col-lg-6 mb-5">
                    <h3>
                        Fisa de date a imobilului
                    </h3>

                    @foreach ($registru->groupBy('B') as $registru_grupat_sector)
                        Sector {{ $registru_grupat_sector->first()->B }} - {{ $registru_grupat_sector->count() }} înregistrări -
                        <a href="registru/export/fisa-de-date-a-imobilului/{{ $registru_grupat_sector->first()->B }}/export-html" target="_blank">
                            Vizualizare html
                        </a>
                        {{-- -
                        <a href="registru/export/fisa-de-date-a-imobilului/{{ $registru_grupat_sector->first()->B }}/export-pdf" target="_blank">
                            export pdf
                        </a> --}}
                        <br>
                        <div class="col-lg-12">
                            Salvare PDF - Pagini:
                            @foreach($registru_grupat_sector->groupBy('C')->chunk(100) as $groupValue => $chunks)
                                <a href="registru/export/fisa-de-date-a-imobilului/{{ $registru_grupat_sector->first()->B }}/export-pdf/{{ $chunks->first()->first()->id }}/{{ $chunks->last()->last()->id }}" target="_blank">
                                {{ $start = $loop->index * 100 + 1 }} - {{ $start + count($chunks) - 1 }}
                                </a>
                                @if (!$loop->last)
                                    /
                                @endif
                            @endforeach
                        </div>

                        <br><br>
                    @endforeach
                </div>

                <div class="col-lg-12">
                    ** Dat fiind faptul ca salvările în format pdf necesită multă putere de procesare, direct proporțional cu numărul de înregistrări, acestea sunt împărțite în grupuri de 100 pagini.<br>
                    <span class="text-danger">*** PDF-urile trebuie generate pe rând. Dacă se încearcă mai multe în același timp e foarte posibil ca serverul să respingă cererile.</span>
                </div>

            </div>


        </div>
    </div>

    {{-- Modal to import excel --}}
    <div id="registruExcelImportForm">
        <div class="modal fade text-dark" id="importaExcel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-success">
                        <h5 class="modal-title text-white" id="exampleModalLabel">Adaugă registru</b></h5>
                        <button type="button" class="btn-close bg-white" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <registru-excel-import-form></registru-excel-import-form>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal to mass delete --}}
    <div class="modal fade text-dark" id="stergeBazaDeDate" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-danger">
                    <h5 class="modal-title text-white" id="exampleModalLabel">Registru</b></h5>
                    <button type="button" class="btn-close bg-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" style="text-align:left;">
                    Ești sigur că vrei ștergi baza de date?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Renunță</button>

                    <form method="POST" action="{{ route('registru.destroyAll') }}">
                        @csrf
                        @method('DELETE')
                        <button
                            type="submit"
                            class="btn btn-danger text-white">
                            Șterge baza de date
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
