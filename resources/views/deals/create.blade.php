@extends('layouts.app')

@section('content')

    <div id="v-deals-create">

        <div class="panel panel-success">
            <div class="panel-heading">
                Izveidot darījumu
            </div>
            <div class="panel-body">
                <form method="POST" action="{{route('deals.store')}}" v-on:submit="showLoader">

                    {{--hidden--}}
                    {{ csrf_field() }}
                    {{ method_field('POST') }}

                    {{--Errors & Validation--}}
                    {{--<div class="row">--}}
                    {{--<div class="col-xs-12">--}}
                    {{--<div v-if="!isValid" class="required-fields">--}}
                    {{--<ul>--}}
                    {{--<li v-show="!validation.NAME">'Skaidras naudas pozīcija' ir obligāta</li>--}}
                    {{--</ul>--}}
                    {{--</div>--}}
                    {{--</div>--}}
                    {{--</div>--}}

                    {{--outlay/income--}}
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="form-group">
                                <div class="radio-inline">
                                    <label for="outlay_0"><input type="radio" name="OUTLAY" id="outlay_0" value="0"
                                                                 v-model.number="form.outlay">Ienākumi</label>
                                </div>
                                <div class="radio-inline">
                                    <label for="outlay_1"><input type="radio" name="OUTLAY" id="outlay_1" value="1"
                                                                 v-model.number="form.outlay">Izdevumi</label>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{--name, amount--}}
                    <div class="row">
                        <div class="col-xs-12 col-sm-6">
                            <div class="form-group"
                                 v-bind:class="{'has-error': !validation.NAME, 'has-success': validation.NAME}">
                                <label for="name">Skaidras naudas pozīcija:</label>
                                <input type="text" class="form-control" name="NAME" id="name"
                                       placeholder="Skaidras naudas pozīcija" v-model="form.name">
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6">
                            <div class="form-group"
                                 v-bind:class="{'has-error': !validation.AMOUNT, 'has-success': validation.AMOUNT}">
                                <label for="amount">Summa:</label>
                                <div class="input-group">
                                    <span class="input-group-addon">&euro;</span>
                                    <input type="tel" class="form-control" name="AMOUNT" id="amount"
                                           placeholder="Summa" v-model.number="form.amount">
                                </div>
                            </div>
                        </div>
                    </div>

                    {{--objects--}}
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="form-group"
                                 v-bind:class="{'has-error': !validation.OBJECT, 'has-success': validation.OBJECT}">
                                <label for="object">Objekts (<a href="#" v-on:click="openModal('', 'objects', 'Jauns objekts')">Pievienot</a>):</label>
                                <select class="form-control" id="object" name="OBJECTS_ID" v-model.number="form.object">
                                    <option value="" selected="selected" disabled="disabled">-</option>
                                    <option v-for="object in options.objects" v-bind:value="object.ID">
                                        @{{ object.NR }} - @{{ object.NAME }}
                                    </option>
                                </select>
                            </div>
                        </div>
                    </div>

                    {{--performer, sections--}}
                    <div class="row" v-if="form.object">
                        <div class="col-xs-6">
                            <div class="form-group"
                                 v-bind:class="{'has-error': !validation.SECTION, 'has-success': validation.SECTION}">
                                <label for="section">Iecirknis (<a href="#" v-on:click="openModal('object', 'sections', 'Jauns iecirknis')">Pievienot</a>):</label>
                                <select class="form-control" id="section" name="SECTIONS_ID" v-model="form.section">
                                    <option value="" selected="selected" disabled="disabled">-</option>
                                    <option v-for="section in options.sections" v-bind:value="section.ID">
                                        @{{ section.NR }} - @{{ section.NAME }}
                                    </option>
                                </select>
                            </div>
                        </div>
                        <div class="col-xs-6">
                            <div class="form-group"
                                 v-bind:class="{'has-error': !validation.PERFORMER, 'has-success': validation.PERFORMER}">
                                <label for="performer">Izpildītājs:</label>
                                <input type="text" class="form-control" name="PERFORMER" id="performer"
                                       placeholder="Izpildītājs" v-model="form.performer">
                            </div>
                        </div>
                    </div>

                    {{--elements, types--}}
                    <div class="row">
                        <div class="col-xs-6">
                            <div class="form-group"
                                 v-bind:class="{'has-error': !validation.ELEMENT, 'has-success': validation.ELEMENT}">
                                <label for="element">Elements (<a href="#" v-on:click="openModal('', 'elements', 'Jauns elements')">Pievienot</a>):</label>
                                <select class="form-control" id="element" name="ELEMENTS_ID" v-model="form.element">
                                    <option value="" selected="selected" disabled="disabled">-</option>
                                    <option v-for="element in options.elements" v-bind:value="element.ID">
                                        @{{ element.NR }} - @{{ element.NAME }}
                                    </option>
                                </select>
                            </div>
                        </div>
                        <div class="col-xs-6">
                            <div class="form-group" v-if="form.element"
                                 v-bind:class="{'has-error': !validation.TYPE, 'has-success': validation.TYPE}">
                                <label for="type">Veids (<a href="#" v-on:click="openModal('element', 'types', 'Jauns veids')">Pievienot</a>):</label>
                                <select class="form-control" id="type" name="TYPES_ID" v-model="form.type">
                                    <option value="" selected="selected" disabled="disabled">-</option>
                                    <option v-for="type in options.types" v-bind:value="type.ID">
                                        @{{ type.NR }} - @{{ type.NAME }}
                                    </option>
                                </select>
                            </div>
                        </div>
                    </div>

                    {{--systems--}}
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="form-group" v-if="form.type"
                                 v-bind:class="{'has-error': !validation.SYSTEM, 'has-success': validation.SYSTEM}">
                                <label for="system">Sistēma (<a href="#" v-on:click="openModal('type', 'systems', 'Jauna sistēma')">Pievienot</a>):</label>
                                <select class="form-control" id="system" name="SYSTEMS_ID" v-model="form.system">
                                    <option value="" selected="selected" disabled="disabled">-</option>
                                    <option v-for="system in options.systems" v-bind:value="system.ID">
                                        @{{ system.NR }} - @{{ system.NAME }}
                                    </option>
                                </select>
                            </div>
                        </div>
                    </div>

                    {{--buttons--}}
                    <a href="{{route('deals.index')}}" class="btn btn-link" style="float: left; color: red;">Atpakaļ</a>
                    {{--<button class="btn btn-link" type="button" v-on:click="resetForm" style="float: left;">Notīrīt laukus</button>--}}
                    <button type="submit" class="btn btn-success" :disabled="!isValid" style="float: right;">Pievienot</button>

                </form>
            </div>
        </div>

        <!-- Modal -->
        <div id="new_name_nr_modal" class="modal fade" role="dialog" tabindex="-1" data-backdrop="static" data-keyboard="false">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        {{--<button type="button" class="close" data-dismiss="modal">&times;</button>--}}
                        <h4 class="modal-title">@{{ modal.title }}</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="new_number">Numurs:</label>
                            <input type="text" class="form-control" id="new_number" v-model="modal.number">
                        </div>
                        <div class="form-group">
                            <label for="new_name">Nosaukums:</label>
                            <input type="text" class="form-control" id="new_name" v-model="modal.name">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" v-on:click="closeModal" style="float: left;">
                            Aizvērt
                        </button>
                        <button type="button" class="btn btn-success" v-on:click="submitModal">Pievienot</button>
                    </div>
                </div>

            </div>
        </div>

    </div>

@endsection
