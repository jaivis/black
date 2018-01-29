<div class="panel panel-default" id="v-deals-filters">

    <div class="panel-heading">
        <h4 class="panel-title">
            <a data-toggle="collapse" href="#filtering">
                <span class="glyphicon glyphicon-search"></span> Filtrēt
            </a>
        </h4>
    </div>
    <div class="panel-body">
        <div id="filtering" class="panel-collapse collapse <?= (isset($_GET['filter'])) ? 'in' : NULL; ?>">

            <form method="GET" action="{{route('deals.index')}}" id="filter_form">
                <div class="row">
                    <div class="col-xs-12 col-sm-4 col-md-2">
                        <div class="form-group">
                            <label for="filter_outlay">Darījums:</label>
                            <select class="form-control" id="filter_outlay" v-model.number="form.outlay">
                                <option value="" selected="selected">-</option>
                                <option value="0">Ienākumi</option>
                                <option value="1">Izdevumi</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-3">
                        <div class="form-group">
                            <label for="filter_name">Nosaukums:</label>
                            <input type="text" class="form-control" id="filter_name"
                                   placeholder="Nosaukums"
                                   <?= (isset($_GET['filter']['name']) && $_GET['filter']['name']) ? "value='{$_GET['filter']['name']}' name='filter[name]'" : NULL; ?> v-model="form.name">
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-2 col-md-1">
                        <div class="form-group"
                             v-bind:class="{'has-error': !validation.AMOUNT, 'has-default': validation.AMOUNT}">
                            <label for="filter_amount">Summa:</label>
                            <input type="tel" class="form-control" id="filter_amount"
                                   placeholder="Summa"
                                   <?= (isset($_GET['filter']['amount']) && $_GET['filter']['amount']) ? "value='{$_GET['filter']['amount']}' name='filter[amount]'" : NULL; ?> v-model.number="form.amount">
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-3">
                        <div class="form-group">
                            <label for="filter_performer">Izpildītājs:</label>
                            <input type="text" class="form-control" id="filter_performer"
                                   placeholder="Izpildītājs"
                                   <?= (isset($_GET['filter']['performer']) && $_GET['filter']['performer']) ? "value='{$_GET['filter']['performer']}' name='filter[performer]'" : NULL; ?> v-model="form.performer">
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-3">
                        <div class="form-group">
                            <label for="filter_objects">Objekti:</label>
                            <select class="form-control" id="filter_objects" v-model.number="form.object">
                                <option value="" selected="selected">-</option>
                                @foreach(\App\Models\Objekt::all() as $object)
                                    <option value="{{$object->ID}}">{{$object->NR}} - {{$object->NAME}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xs-12 col-sm-6 col-md-3">
                        <div class="form-group">
                            <label for="filter_sections">Iecirkņi:</label>
                            <select multiple size="10" class="form-control" name="filter[sections_id][]"
                                    id="filter_sections"
                                    v-model="form.section" :disabled="form.object == ''">
                                {{--<option value="" selected="selected">-</option>--}}
                                <option v-for="section in options.sections" v-bind:value="section.ID">
                                    @{{ section.NR }} - @{{ section.NAME }}
                                </option>
                            </select>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-3">
                        <div class="form-group">
                            <label for="filter_elements">Elementi:</label>
                            <select multiple size="10" class="form-control" name="filter[elements_id][]"
                                    id="filter_elements"
                                    v-model="form.element">
                                @foreach(\App\Models\Element::all() as $element)
                                    <option value="{{$element->ID}}">{{$element->NR}} - {{$element->NAME}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-3">
                        <div class="form-group">
                            <label for="filter_types">Veidi:</label>
                            <select multiple size="10" class="form-control" name="filter[types_id][]" id="filter_types"
                                    v-model="form.type" :disabled="(form.element).length == 0">
                                <option v-for="type in options.types" v-bind:value="type.ID">
                                    @{{ type.NR }} - @{{ type.NAME }}
                                </option>
                            </select>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-3">
                        <div class="form-group">
                            <label for="filter_systems">Sistēmas:</label>
                            <select multiple size="10" class="form-control" name="filter[systems_id][]"
                                    id="filter_systems"
                                    v-model="form.system" :disabled="(form.type).length == 0">
                                <option v-for="system in options.systems" v-bind:value="system.ID">
                                    @{{ system.NR }} - @{{ system.NAME }}
                                </option>
                            </select>
                        </div>
                    </div>
                </div>

                @if(isset($_GET['filter']))
                    <a href="{{route('deals.index')}}" class="btn btn-link" style="float: left; color: red;">Atcelt
                        filtrus</a>
                @endif

                <button class="btn btn-link" type="button"
                        v-on:click="resetForm" style="float: left;">
                    Notīrīt laukus
                </button>

                <button type="submit" class="btn btn-primary" style="float: right;" :disabled="!isValid">Filtrēt
                </button>
            </form>
        </div>
    </div>
</div>

<script src="{{ mix('js/deals/filters.js') }}"></script>