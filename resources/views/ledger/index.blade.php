@extends('template')

@section('section1')




<div class="col s12 m12 l12 searchnav" style="padding:1%;background:#f5f5f5;">

    <div class="col s12 m6 l6 flexdiv">
        <a class="btn back-btn tooltipped" href="" data-position="bottom" data-delay="200" data-tooltip="go back">
            <span class="mdi mdi-arrow-left"></span>
        </a>
        <a id="download-button" class="btn add-btn tooltipped" data-position="bottom" data-delay="200"
        data-tooltip="PDF">
        <span>Download</span></a>
    </div>

    <div class="col s12 m6 l6">
        {{-- <form action="{{route('ledger',[$id])}}" method="get" class="form-inline">
            @csrf
            <div class="input-field col s5">

                <input type="date" name="fdate" class="form-control" required>
            </div>

            <div class="input-field col s2">

                <input type="date" name="tdate" class="form-control" required>
            </div>



            <div class="input-field col s2">
                <button name="search" class="btn btn-success mb-2">Search</button>
            </div>
        </form> --}}
    </div>
</div>

<div id="ledgerpdf">
    <div class="z-depth-5" style=" padding:1%;background-color: white;">
            <table class="bordered" style="width:50%;">
                <caption>
                    <h3 class="thin">
                        <span class="mdi mdi-account-star"></span>
                        <?php
                        $user_name=explode('.',$user->name);
                        ?>
                        {{ $user_name[0] }} {{ $user_name[1] }}
                        Ledger
                    </h3>
                </caption>

                <thead>

                </thead>

                <tbody>

                    <tr>
                        <th style="font-size:18px;">Contact Number</th>

                        <td style="font-size:18px;">{{ $user->mobileno }}</td>
                    </tr>

                    <tr>
                        <th style="font-size:18px;">Email</th>

                        <td style="font-size:18px;">{{ $user->email }}</td>
                    </tr>

                    <tr>
                        <th style="font-size:18px;">City</th>

                        <td style="font-size:18px;">{{ $city->name }}</td>
                    </tr>

                    <tr>
                        <th style="font-size:18px;">Address</th>
                        <td style="font-size:18px;">{{ $user->address }}</td>
                    </tr>

                    <tr>
                        <th style="font-size:18px;">Opening Balance</th>
                        <td style="font-size:18px;">{{ $user->start_bal }}</td>
                    </tr>

                    <tr>
                        <th style="font-size:18px;">Current Balance</th>
                        <td style="font-size:18px;">{{ $user->current_bal }}</td>
                    </tr>
                </tbody>
            </table>

                <table id="myTable" class="highlight bordered" style="margin-top:50px;">
                    <caption>
                    </caption>
                    <thead style="color:#fff; border:1px solid black; background-color:#0C4397;">
                        <tr>


                            <th style="font-size:17px; width:60px;"> Date</th>
                            <th style="font-size:17px; width:80px;"> Description</th>
                            <th style="font-size:17px; width:60px;"> - Credit</th>
                            <th style="font-size:17px; width:60px;"> + Debit</th>
                            <th style="font-size:17px; width:10px;"> Balance</th>



                        </tr>
                    </thead>

                    <tbody>
                        <?php $tbalance=0; ?>
                        @foreach($showtran as $tran)

                        <tr>
                            <td style="font-size:15px;">{{$tran->trans_date}}</td>
                            @if($tran->sale_id==null)
                            <td>{{$tran->trans_description}}</td>

                            @else
                            <td style="font-size:15px;"><a href="{{ route('sale.show',  $tran->sale_id) }}">{{$tran->trans_description}}</a></td>
                            @endif
                            @if($tran->trans_operator=='+')
                            <td style="font-size:15px;">{{$tran->amount}}</td>
                            @else
                            <td>-</td>
                            @endif
                            @if($tran->trans_operator=='-')
                            <td style="font-size:15px;">{{$tran->amount}}</td>
                            @else
                            <td style="font-size:15px;">-</td>
                            @endif
                            <td style="font-size:15px;">
                                <?php
                        $credit = '0';
                        $debit = '0';
                        if($tran->trans_operator=='+')
                        {
                            $credit = $tran->amount;

                        }
                        elseif($tran->trans_operator=='-')
                        {
                            $debit= $tran->amount;

                        }
                            $chkbala=$credit-$debit;
                        


                            echo $tbalance += $chkbala;
                            ?>
                            </td>

                        </tr>

                        @endforeach

                    </tbody>
                    <tr>
                        <td>

                        </td>
                        <td>
                            <strong style="font-size:15px;"> Total Credit:</strong> {{$totalcredit}} Rs/-
                        </td>
                        <td>
                            <strong style="font-size:15px;"> Total Debit:</strong> {{$totaldebit}} Rs/-
                        </td>
                        <td>

                        </td>
                        <td>
                            <strong style="font-size:15px;"> Total Balance:</strong> {{$totalbal}} Rs/-
                        </td>
                    </tr>
                </table>

    </div>
</div>




<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.js">
</script>
<script type="text/javascript">
    $(document).ready(function () {
        $('#myTable').DataTable();
    });

</script>




<script>
    const button = document.getElementById('download-button');

    function generatePDF() {
        // Choose the element that your content will be rendered to.
        const element = document.getElementById('ledgerpdf');
        // Choose the element and save the PDF for your user.
        html2pdf().from(element).save();
    }

    button.addEventListener('click', generatePDF);

</script>


</div>

@stop
