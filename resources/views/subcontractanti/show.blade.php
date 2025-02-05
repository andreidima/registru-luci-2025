@extends ('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="shadow-lg" style="border-radius: 40px;">
                <div class="border border-secondary p-2 culoare2" style="border-radius: 40px 40px 0px 0px;">
                    <span class="badge text-light fs-5">
                        <i class="fa-solid fa-handshake me-1"></i> Detalii Subcontractant
                    </span>
                </div>

                <div class="card-body border border-secondary p-4" style="border-radius: 0px 0px 40px 40px;">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <strong>Nume:</strong> {{ $subcontractant->nume }}
                        </div>
                        <div class="col-md-6 mb-3">
                            <strong>Tip:</strong> {{ $subcontractant->tip }}
                        </div>
                        <div class="col-md-6 mb-3">
                            <strong>Număr înregistrare:</strong> {{ $subcontractant->numar_inregistrare }}
                        </div>
                        <div class="col-md-6 mb-3">
                            <strong>Cod fiscal:</strong> {{ $subcontractant->cod_fiscal }}
                        </div>
                        <div class="col-md-6 mb-3">
                            <strong>Status:</strong> {{ $subcontractant->status }}
                        </div>
                        <div class="col-md-6 mb-3">
                            <strong>Email:</strong> <a href="mailto:{{ $subcontractant->email }}">{{ $subcontractant->email }}</a>
                        </div>
                        <div class="col-md-6 mb-3">
                            <strong>Telefon:</strong> {{ $subcontractant->telefon }}
                        </div>
                        <div class="col-md-12 mb-3">
                            <strong>Adresă:</strong> {{ $subcontractant->adresa }}
                        </div>
                        <div class="col-md-6 mb-3">
                            <strong>Oraș:</strong> {{ $subcontractant->oras }}
                        </div>
                        <div class="col-md-6 mb-3">
                            <strong>Cod poștal:</strong> {{ $subcontractant->cod_postal }}
                        </div>
                        <div class="col-md-6 mb-3">
                            <strong>Țară:</strong> {{ $subcontractant->tara }}
                        </div>
                        <div class="col-md-6 mb-3">
                            <strong>Data început contract:</strong> {{ $subcontractant->data_inceput_contract?->format('d.m.Y') }}
                        </div>
                        <div class="col-md-6 mb-3">
                            <strong>Data sfârșit contract:</strong> {{ $subcontractant->data_sfarsit_contract?->format('d.m.Y') }}
                        </div>
                        <div class="col-md-6 mb-3">
                            <strong>Tarif orar:</strong> {{ $subcontractant->tarif_orar }} {{ $subcontractant->moneda ?? '' }}
                        </div>
                        <div class="col-md-6 mb-3">
                            <strong>Preț fix:</strong> {{ $subcontractant->pret_fix }} {{ $subcontractant->moneda ?? '' }}
                        </div>
                        <div class="col-md-6 mb-3">
                            <strong>Condiții plată:</strong> {{ $subcontractant->conditii_plata ?? 'Nespecificate' }}
                        </div>
                        <div class="col-md-6 mb-3">
                            <strong>Specializare:</strong> {{ $subcontractant->specializare }}
                        </div>
                        <div class="col-md-12 mb-3">
                            <strong>Observații:</strong> {{ $subcontractant->observatii ?? 'Nicio observație' }}
                        </div>
                        <div class="col-md-6 mb-3">
                            <strong>Creat la:</strong> {{ $subcontractant->created_at?->format('d.m.Y H:i') }}
                        </div>
                        <div class="col-md-6 mb-3">
                            <strong>Ultima modificare:</strong> {{ $subcontractant->updated_at?->format('d.m.Y H:i') }}
                        </div>
                    </div>

                    <div class="d-flex justify-content-center mt-4">
                        <a href="{{ route('subcontractanti.edit', $subcontractant->id) }}" class="btn btn-primary text-white me-3 rounded-3">
                            <i class="fa-solid fa-edit me-1"></i> Modifică
                        </a>
                        <a class="btn btn-secondary rounded-3" href="{{ Session::get('returnUrl', route('subcontractanti.index')) }}">
                            <i class="fa-solid fa-arrow-left me-1"></i> Înapoi
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
