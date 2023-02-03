@extends('template')

<style>
    .toolbar {
        float: left;
    }

    .input-field {
        display: none;
    }

    .dataTables_filter input {
        background-color: transparent !important;
        border: none !important;
        border-bottom: 1px solid #9e9e9e !important;
        border-radius: 0 !important;
        outline: none !important;
        height: 1.5rem !important;
        width: 100% !important;
        font-size: 1rem !important;
        margin: 0 0 20px 0 !important;
        padding: 0 !important;
        -webkit-box-shadow: none;
        box-shadow: none !important;
        -webkit-box-sizing: content-box;
        box-sizing: content-box;
        -webkit-transition: all 0.3s;
        transition: all 0.3s;
    }

    .dataTables_filter input:focus {
        border-bottom: 1px solid #9fa8da !important;
        box-shadow: 0 1px 0 0 #9fa8da !important;
    }

    .dataTables_filter {
        position: absolute;
        top: -32px;
        right: 7px;
    }

    .flexdiv {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .flexdiv .add-btn,
    .flexdiv .back-btn {
        display: flex;
        width: max-content;
        align-items: center;
    }

    .dataTables_filter label {
        font-size: 18px;
        color: #000;
        display: flex;
    }

    table.dataTable tbody td {
        padding: 20px 10px !important;
    }

    @media(max-width:490px) {
        .searchnav {
            min-height: 110px !important;
        }

        .dataTables_filter {
            left: 0;
            top: -43px;
            padding: 0px 13px;
        }

    }
</style>
@section('section1')

    <br>
    <div class="col s12 m12 l12 searchnav" style="padding:1%;background:#f5f5f5;">

        <div class="col s12 m6 l6 flexdiv">
            <a class="btn back-btn tooltipped" href="{{ url(URL::previous()) }}" data-position="bottom" data-delay="200"
                data-tooltip="go back">
                <span class="mdi mdi-arrow-left"></span>
            </a>
            <a class="btn add-btn tooltipped" href="{{ route('client_create') }}" data-position="bottom" data-delay="200"
                data-tooltip="add new">
                <span class="mdi mdi-plus"></span>
            </a>
        </div>

        <div class="col s12 m6 l6">

            @if (isset($column_list))
                {!! Form::open(['url' => $entity . '/search', 'method' => 'get']) !!}
                <div class="input-field col s5">
                    {!! Form::text('keyword', null, ['placeholder' => 'Search ' . $entity, 'id' => 'searchInput']) !!}
                </div>

                {{ $column_list }}

                <div class="input-field col s2">
                    {!! Form::button('<span class="mdi mdi-magnify"></span>', [
                        'class' => 'btn search-btn',
                        'type' => 'submit',
                        'id' => 'searchButton',
                    ]) !!}
                </div>
                {!! Form::close() !!} --}}
            @endif
        </div>
    </div>
    {{--
      @component('components.index_header', ['entity' => 'client'])
    @slot('column_list')
      <div class="input-field col s5">
        {!! Form::select('column', [
          'first_name' => 'First Name',
          'last_name' => 'Last Name',
          'mobile_no' => 'Mobile #',
          'email' => 'Email',
          'current_bal' => 'Balance'
        ], null, ['placeholder' => 'Select Column', 'required' => 'required']) !!}
      </div>
    @endslot
  @endcomponent
  --}}

    <div class="z-depth-5" style="padding:1%;background-color: white;">

        {{-- @if ($Clients->isEmpty()) --}}
        {{-- <center>
        <h3 class="thin">No Record Found !</h3>
      </center> --}}
        {{-- @else --}}

        <table class="highlight bordered display" id="clientTable">

            <caption>
                <h3 class="thin">
                    <span class="mdi mdi-account-star"></span>
                    Clients
                </h3>
            </caption>

            <thead>
                <tr>
                    <th hidden>No#</th>
                    <th style="padding-right:160px;">Client Name</th>
                    <th>Mobile #</th>
                    <th>City</th>
                    <th>Address</th>
                    <th>Current Balance</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody>
                {{-- @foreach ($Clients as $Client) --}}
                <tr>
                    {{-- <td hidden>{{$i++}}</td> --}}
                    {{-- <td>{{ $Client['user']['person']['first_name']." ".$Client['user']['person']['last_name'] }}</td> --}}
                    {{-- <td>{{ $Client['user']['person']['land_line_no'] }}</td> --}}
                    {{-- <td>{{ $Client['user']['person']['mobile_no'] }}</td> --}}
                    {{-- <td>{{ $Client['user']['person']['city']['name'] }}</td> --}}
                    {{-- <td>{{ $Client['user']['person']['address'] }}</td> --}}
                    {{-- <td>{{ $Client->current_bal }}</td> --}}
                    <td>asd</td>
                    <td>asd</td>
                    <td>asd</td>
                    <td>asd</td>
                    <td>sad</td>

                    <td>
                        <a class="action-btn single-btn" href="">
                            <span class="mdi mdi-script"></span>
                        </a>
                        <a class="action-btn edit-btn" href="">
                            <span class="mdi mdi-pen"></span>
                        </a>
                        <a class="action-btn single-btn" href="">
                            <span class="mdi mdi-chevron-right"></span>
                        </a>
                    </td>
                </tr>
                {{-- @endforeach --}}
            </tbody>
        </table>
        {{-- @endif --}}


    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script>
        $(document).ready(function() {
            $('#clientTable').DataTable({
                "pageLength": 25,
                order: [
                    [0, 'asc']
                ],
                dom: '<"toolbar">frtip',
            });

            $('div.toolbar').html('');
        });
    </script>
    <script type="text/javascript">
        function sortTable(table, order) {
            var asc = order === 'asc',
                tbody = table.find('tbody');

            tbody.find('tr').sort(function(a, b) {
                if (asc) {
                    return $('td:first', a).text().localeCompare($('td:first', b).text());
                } else {
                    return $('td:first', b).text().localeCompare($('td:first', a).text());
                }
            }).appendTo(tbody);

        }

        sortTable($('#clientTable'), 'asc');

        $(document).ready(function() {
            $("form .s5:nth-child(2)").empty();
        });

        $(document).ready(function() {
            $('#searchButton').attr('disabled', true);

            $('#searchInput').on('input', function() {

                if ($('#searchInput').val() == '') {
                    $('#searchButton').attr('disabled', true)
                } else {
                    $('#searchButton').attr('disabled', false)
                }
            })
        });
    </script>

@stop
