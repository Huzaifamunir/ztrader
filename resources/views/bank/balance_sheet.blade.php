@extends('template')

@section('section1')



<div class="col s12 m12 l12 searchnav" style="padding:1%;background:#f5f5f5;">

    <div class="col s12 m6 l6 flexdiv">
        <a class="btn back-btn tooltipped" href="{{url(URL::previous())}}" data-position="bottom" data-delay="200" data-tooltip="go back">
            <span class="mdi mdi-arrow-left"></span>
        </a>
    
    </div>

    <div class="col s12 m6 l6">
        <form action="{{route('bank.show',[$bank_id])}}" method="get" class="form-inline">
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
        </form>
    </div>
</div>

<div class="z-depth-5" style="padding:1%;background-color: white;">





    <div class="z-depth-5" style="padding:1%;background-color: white;">


        @if(isset($showtranfilter))


        <table class="highlight bordered" id="myTable">
            <caption>
                <h3 class="thin">Balance Sheet</h3>
            </caption>
            <thead>
                <tr>
                    <th> Date</th>
                    <th> Description</th>
                    <th> credit</th>
                    <th> Debit</th>
                    <th> balance</th>



                </tr>
            </thead>

            <tbody>


            <tbody>
                <?php $tbalance=0;?>
                @foreach($showtranfilter as $filtertran)

                <tr>
                    <td>{{$filtertran->trans_date}}</td>
                    <td>{{$filtertran->trans_description}}</td>
                    @if($filtertran->trans_operator=='+')
                    <td>{{$filtertran->amount}}</td>
                    @else
                    <td>-</td>
                    @endif
                    @if($filtertran->trans_operator=='-')
                    <td>{{$filtertran->amount}}</td>
                    @else
                    <td>-</td>
                    @endif
                    <td>
                        <?php
        $credit = '0';
        $debit = '0';
      
        if($filtertran->trans_operator=='+')
        {
            $credit = $filtertran->amount;
      
        }
         elseif($filtertran->trans_operator=='-')
        {
               $debit= $filtertran->amount;
      
        }
             $chkbala=$credit-$debit;
            // echo $debit;
             
      
      
             echo $tbalance += $chkbala;
             
             ?>
                    </td>

                </tr>

                @endforeach

                <tr>
                    <td>

                    </td>
                    <td>
                        <strong> Total Credit:</strong> {{$totalcreditfilter}} Rs/-
                    </td>
                    <td>
                        <strong> Total Debit:</strong> {{$totaldebitfilter}} Rs/-
                    </td>
                    <td>

                    </td>
                    <td>
                        <strong> Total Balance:</strong> {{$totalbalfilter}} Rs/-
                    </td>
                </tr>


            </tbody>
        </table>

    </div>

    @else



    <table id="myTable" class="highlight bordered">
        <caption>
            <h3 class="thin">Balance Sheet</h3>
        </caption>
        <thead>
            <tr>


                <th> Date</th>
                <th> Description</th>
                <th> credit</th>
                <th> Debit</th>
                <th> balance</th>



            </tr>
        </thead>

        <tbody>
            <?php $tbalance=0; ?>
            @foreach($showtran as $tran)

            <tr>
                <td>{{$tran->trans_date}}</td>
                <td>{{$tran->trans_description}}</td>
                @if($tran->trans_operator=='+')
                <td>{{$tran->amount}}</td>
                @else
                <td>-</td>
                @endif
                @if($tran->trans_operator=='-')
                <td>{{$tran->amount}}</td>
                @else
                <td>-</td>
                @endif
                <td>
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
    // echo $debit;


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
                <strong> Total Credit:</strong> {{$totalcredit}} Rs/-
            </td>
            <td>
                <strong> Total Debit:</strong> {{$totaldebit}} Rs/-
            </td>
            <td>

            </td>
            <td>
                <strong> Total Balance:</strong> {{$totalbal}} Rs/-
            </td>
        </tr>
    </table>

    @endif

    @stop

    @section('js_link')
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.js">
    </script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('#myTable').DataTable();
        });

    </script>
    {{-- @endif   --}}

</div>

@stop
