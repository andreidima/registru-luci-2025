@extends ('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-12">
            <div class="shadow-lg" style="border-radius: 40px 40px 40px 40px;">
                <div class="border border-secondary p-2 culoare2" style="border-radius: 40px 40px 0px 0px;">
                    <span class="badge text-light fs-5">
                        <i class="fa-solid fa-handshake me-1"></i>
                        {{ isset($subcontractant) ? 'Editează Subcontractant' : 'Adaugă Subcontractant' }}
                    </span>
                </div>

                @include ('errors.errors')

                <div id="datePicker" class="card-body py-3 px-4 border border-secondary"
                    style="border-radius: 0px 0px 40px 40px;"
                >
                    <form class="needs-validation" novalidate
                          method="POST"
                          action="{{ isset($subcontractant) ? route('subcontractanti.update', $subcontractant->id) : route('subcontractanti.store') }}">
                        @csrf
                        @if(isset($subcontractant))
                            @method('PUT')
                        @endif

                        @include ('subcontractanti.form', [
                            'subcontractant' => $subcontractant ?? null,
                            'buttonText' => isset($subcontractant) ? 'Salvează modificările' : 'Adaugă Subcontractant',
                        ])
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
