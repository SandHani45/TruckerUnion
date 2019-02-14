@extends('master')

@include('layouts.header')

@include('layouts.footer')

@section('title')

@endsection

@section('main-content')


  <!--==========================
    Intro Section
  ============================-->
  <section id="drop" class="search-set">
    <div class="container">
      <div class="row pd-top-15">
        <div class="col-sm-12 mt-0">
          <h4><b>Prabh’s </b>Drop off points</h4>
        </div>
      </div>
      <hr>
      <div class="row">
        <div class="col-sm-6">
            <div class="input-group mb-3">
              <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search points" title="Type in a name" class="form-control" aria-label="Recipient's username" aria-describedby="basic-addon2">
              <div class="input-group-append">
                <button class="btn btn-outline-secondary" type="button">Search</button>
              </div>
            </div>
        </div> 
      </div>
    
    </div>
    <div class="row ml-5 col-md-8">

            <table id="myTable" class="ml-search">
            @foreach($drop_poins as $drop_point)
              <tr>
                <td><a href="{{ route('drop_points.edit', $drop_point->id)}}">{{ $drop_point->name }}</a></td>
                <td><a class="" href="" onclick="
                                  if(confirm('Are sure, you want to delete this?'))
                                  {
                                    event.preventDefault();
                                    document.getElementById('delete-form-{{$drop_point->id}}').submit();
                                  }else
                                  {
                                    event.preventDefault();
                                  }"> {{ __('Delete') }}
                    </a>
                    <form id="delete-form-{{$drop_point->id}}" action="{{ route('drop_points.destroy', $drop_point->id) }}" style="display: none;" method="post">
                      @csrf
                      {{method_field('DELETE')}}
                    </form>
                </td>
              </tr>
            @endforeach  
            </table>
       
    </div>
      

  </section><!-- #intro -->






@endsection 

@section('script-top')

<script>
function myFunction() {
  var input, filter, table, tr, td, i;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[0];
    if (td) {
      if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }       
  }
}
</script>

@endsection