@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6 mb-5">
            <div class="card culoare2">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    Bine ai venit <b>{{ auth()->user()->name ?? '' }}</b>!
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4 mb-3">
            <div class="card culoare2">
                <div class="card-header text-center">Proiecte luna trecută</div>
                <div class="card-body text-center">
                    <b class="fs-2">{{ $proiecteLastMonth }}</b>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card culoare2">
                <div class="card-header text-center">Proiecte luna curentă</div>
                <div class="card-body text-center">
                    <b class="fs-2">{{ $proiecteThisMonth }}</b>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card culoare2">
                <div class="card-header text-center">Total Proiecte</div>
                <div class="card-body text-center">
                    <b class="fs-2">{{ $allProiecteCount }}</b>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 mb-3">
            <div class="table-responsive rounded">
                <table class="table table-striped table-hover rounded">
                    <thead class="text-white rounded">
                        <tr class="thead-danger" style="padding:2rem">
                            <th class="text-white culoare2 text-center" colspan="{{ $proiecteGroupedByStareContract->count() }}">Stare proiecte</th>
                        </tr>
                        <tr class="thead-danger" style="padding:2rem">
                            @foreach ($proiecteGroupedByStareContract as $stareContract)
                                <th class="text-white culoare2 text-center" style="width:{{ 100/$proiecteGroupedByStareContract->count() }}%">
                                    {{ $stareContract->stare_contract ?? '-'}}
                                </th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                            @foreach ($proiecteGroupedByStareContract as $stareContract)
                                <th class="text-white culoare2 text-center">
                                    <b class="fs-2">{{ $stareContract->total }}</b>
                                </th>
                            @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection

