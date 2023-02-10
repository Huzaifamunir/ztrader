@extends('template')

@section('section1')



<div class="z-depth-5" style="padding:1%;background-color: white;">

    <form action="{{route('Add_Transiction')}}" method="POST" enctype="multipart/form-data">
        @csrf
          <input type="hidden"  name="bank_id" value="{{ $id->bank_id }}">
            <div class="row">
             <div class="col">
              <label>Date</label>
                <input type="date" name="trans_date" class="form-control">
             </div>
             <div class="col">
                <label>Operation</label>
                <select name="trans_operator" id="" class="form-control">
                    <option value="+">Cridit</option>
                    <option value="-">Debit</option>
                </select>
             </div>
            </div>

            <div class="row">
             <div class="col">
                <label>Amount</label>
                <input type="number" name="amount" class="form-control">
             </div>
            </div>

            <div class="row">
             <div class="col">
                <label for="exampleFormControlTextarea1">Description</label>
                <textarea name="trans_description" class="form-control"id="exampleFormControlTextarea1" rows="3"name="description"></textarea>
             </div>
            </div>
            <!-- row ended here -->
            <div class="row mt-5 ">
             <div class="col">
                <button style="float: right;" type="submit"class="btn btn-primary">Submit</button>
             </div>
            </div>

    </form>


</div>


@stop