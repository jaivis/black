<div class="panel panel-default">

    <div class="panel-heading">
        <h4 class="panel-title">
            <a data-toggle="collapse" href="#filtering">
                <span class="glyphicon glyphicon-search"></span> Filtrēt
            </a>
        </h4>
    </div>
    <div class="panel-body">
        <div id="filtering" class="panel-collapse collapse">

            <form method="GET" action="{{route('deals.index')}}" id="filter_form">
                <div class="row">
                    <div class="col-xs-12 col-sm-4 col-md-1">
                        <div class="form-group">
                            <label for="filter_outlay">Darījums:</label>
                            <select class="form-control" id="filter_outlay" name="_fout">
                                <option value="" selected="selected">-</option>
                                <option value="0">Ienākumi</option>
                                <option value="1">Izdevumi</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-3">
                        <div class="form-group">
                            <label for="filter_name">Nosaukums:</label>
                            <input type="text" class="form-control" name="_fnam" id="filter_name"
                                   placeholder="Nosaukums" value="{{old('_fnam')}}">
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-2 col-md-2">
                        <div class="form-group">
                            <label for="filter_amount">Summa:</label>
                            <input type="tel" class="form-control" name="_famo" id="filter_amount"
                                   placeholder="Summa">
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-3">
                        <div class="form-group">
                            <label for="filter_objects">Objekti:</label>
                            <select class="form-control" name="_fobj" id="filter_objects">
                                <option value="" selected="selected">-</option>
                                @foreach(\App\Models\Objekt::all() as $object)
                                    <option value="{{$object->ID}}">{{$object->NR}} - {{$object->NAME}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-3">
                        <div class="form-group">
                            <label for="filter_performer">Izpildītājs:</label>
                            <input type="text" class="form-control" name="_fper" id="filter_performer"
                                   placeholder="Izpildītājs">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xs-12 col-sm-6 col-md-3">
                        <div class="form-group">
                            <label for="filter_sections">Iecirkņi:</label>
                            <select multiple class="form-control" name="_fsec" id="filter_sections">
                                <option>1</option>
                                <option>2</option>
                                <option>3</option>
                                <option>4</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-3">
                        <div class="form-group">
                            <label for="filter_elements">Elementi:</label>
                            <select multiple class="form-control" name="_fele" id="filter_elements">
                                <option>1</option>
                                <option>2</option>
                                <option>3</option>
                                <option>4</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-3">
                        <div class="form-group">
                            <label for="filter_types">Veidi:</label>
                            <select multiple class="form-control" name="_ftyp" id="filter_types">
                                <option>1</option>
                                <option>2</option>
                                <option>3</option>
                                <option>4</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-3">
                        <div class="form-group">
                            <label for="filter_systems">Sistēmas:</label>
                            <select multiple class="form-control" name="_fsys" id="filter_systems">
                                <option>1</option>
                                <option>2</option>
                                <option>3</option>
                                <option>4</option>
                            </select>
                        </div>
                    </div>
                </div>

                <a href="{{route('deals.index')}}" class="btn btn-link" style="float: left; color: red;">Atcelt
                    filtrus</a>
                <button class="btn btn-link" type="button"
                        onclick="document.getElementById('filter_form').reset();" style="float: left;">Notīrīt laukus
                </button>
                <button type="submit" class="btn btn-primary" style="float: right;">Filtrēt</button>
            </form>
        </div>
    </div>
</div>