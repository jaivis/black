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
            <table class="table table-hover table-bordered">
                <thead>
                <tr>
                    {{--<th></th>--}}
                    <th>Nosaukums</th>
                    <th>Summa</th>
                    <th>Objekts</th>
                    <th>Iecirknis</th>
                    <th>Elements</th>
                    <th>Veids</th>
                    <th>Sistēma</th>
                    <th>Izpildītājs</th>
                    <th>Izveidots</th>
                    <th></th>
                </tr>
                </thead>
                <tfoot>
                <tr>
                    {{--<th></th>--}}
                    <th>Nosaukums</th>
                    <th>Summa</th>
                    <th>Objekts</th>
                    <th>Iecirknis</th>
                    <th>Elements</th>
                    <th>Veids</th>
                    <th>Sistēma</th>
                    <th>Izpildītājs</th>
                    <th>Izveidots</th>
                    <th></th>
                </tr>
                </tfoot>
                <?php foreach($deals as $key => $deal): ?>
                <tr class="item">
                    {{--<td>{{$deal->ID}}</td>--}}
                    <td>{{$deal->NAME}}</td>
                    <td class="{{ ($deal->OUTLAY) ? 'cash-out' : 'cash-in' }}">{{ number_format($deal->AMOUNT, 2)}}</td>
                    <td>{{$deal->OBJECT_NR}} - {{$deal->OBJECT_NAME}}</td>
                    <td>{{$deal->SECTION_NR}} - {{$deal->SECTION_NAME}}</td>
                    <td>{{$deal->ELEMENT_NR}} - {{$deal->ELEMENT_NAME}}</td>
                    <td>{{$deal->TYPE_NR}} - {{$deal->TYPE_NAME}}</td>
                    <td>{{$deal->SYSTEM_NR}} - {{$deal->SYSTEM_NAME}}</td>
                    <td>{{$deal->PERFORMER}}</td>
                    <td title="izveidots: {{$deal->created_at . "\n"}}labots: {{$deal->updated_at}}">{{$deal->created_at}}</td>
                    <td class="text-center">
                        <a href="{{ route('deals.edit', $deal->ID) }}" style="padding-right: 15px;">
                            <span class="glyphicon glyphicon-pencil"></span>
                        </a>
                        <a href="{{ route('deals.destroy', $deal->ID) }}" data-method="delete"
                           data-token="{{csrf_token()}}" data-confirm="Dzēst šo darījumu '{{$deal->OBJECT_NR}} - {{$deal->OBJECT_NAME}}'?">
                            <span class="glyphicon glyphicon-trash"></span>
                        </a>
                    </td>
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
