@extends('layouts.app')

@section('content')

    <div id="deals">
        <h2>
            Darījumu saraksts
            <a href="{{route('deals.create')}}" class="btn btn-link" role="button">
                <span class="glyphicon glyphicon-plus"></span> Pievienot
            </a>
        </h2>

        {{--filtering component--}}
        @include('deals.filters')

        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        {{--<th></th>--}}
                        <th>Nosaukums</th>
                        <th>Summa</th>
                        <th>Objekts</th>
                        <th>Elements</th>
                        <th>Veids</th>
                        <th>Izpildītājs</th>
                        <th>Iecirknis</th>
                        <th>Sistēma</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        {{--<th></th>--}}
                        <th>Nosaukums</th>
                        <th>Summa</th>
                        <th>Objekts</th>
                        <th>Elements</th>
                        <th>Veids</th>
                        <th>Izpildītājs</th>
                        <th>Iecirknis</th>
                        <th>Sistēma</th>
                    </tr>
                </tfoot>
                <?php foreach($deals as $key => $deal): ?>
                <tr class="item">
                    {{--<td>{{$deal->ID}}</td>--}}
                    <td>{{$deal->NAME}}</td>
                    <td class="{{ ($deal->OUTLAY) ? 'cash-out' : 'cash-in' }}">{{ number_format($deal->AMOUNT, 2)}}</td>
                    <td>{{$deal->OBJECT_NAME}}</td>
                    <td>{{$deal->ELEMENT_NAME}}</td>
                    <td>{{$deal->TYPE_NAME}}</td>
                    <td>{{$deal->PERFORMER}}</td>
                    <td>{{$deal->SECTION_NAME}}</td>
                    <td>{{$deal->SYSTEM_NAME}}</td>
                </tr>
                <?php endforeach; ?>
            </table>
        </div>
        <div>
            <center>
                {{ $deals->links() }}
            </center>
            <center>
                Kopā:{{ $deals->total() }}
            </center>
        </div>

    </div>


@endsection
