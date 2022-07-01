@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-light text-center" style="background-color: #0e0a31">{{ __('Convertidor de Moneda') }}</div>
                <form action="{{ route('convertirmoneda') }}" method="post">
                    @csrf
                    <div class="card-body pt-5">
                        <div class="row justify-content-center">
                            <div class="col-md-4">
                                <input type="text" inputmode="decimal" autocomplete="off" value="1.00" name="montoConver">
                            </div>
                            <div class="col-md-4">
                                <select class="form-select"  name="deMoneda">
                                    <option selected>Selecciona una opcion</option>
                                    @foreach ($arrayOfCurrencie  as $currencies)
                                    <option value="{{ $currencies['id'] }}" class="text-center">{{ $currencies['currencyName'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4">
                                <select class="form-select"  name="aMoneda">
                                    <option selected>Selecciona una opcion</option>
                                    @foreach ($arrayOfCurrencie as $currencies)
                                        <option value="{{ $currencies['id'] }}" class="text-center">{{ $currencies['currencyName'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <input type="text" name="idUser" value="{{ $idUser }}" style="display: none;">
                        </div>
                        <div class="pt-5">
                            <button type="submit" class="btn text-light " style="background-color: #0e0a31">
                                {{ __('Convertir') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            <br>
            <div class="card">
                @if(Session::has('monto_convertido'))
                    <div class="card-body">
                        <div class="col-md-4 ">
                            <div style="background:green;color:white;height:60px;text-align:center;padding-top:5px" class="rounded">
                                {{Session::get('monto_convertido')}} 
                            </div>
                        </div>
                    </div>
                @endif
                @if(Session::has('numero_de_conversiones_alcanzadas'))
                    <div class="card-body">
                        <div class="col-md-4 ">
                            <div style="background:red;color:white;height:60px;text-align:center;padding-top:5px" class="rounded">
                            {{Session::get('numero_de_conversiones_alcanzadas')}} 
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
