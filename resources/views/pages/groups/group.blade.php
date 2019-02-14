
@extends('master')

@include('layouts.header')

@include('layouts.footer')


@section('style')
<style type="text/css">
  .nav-menu .log {
    padding: 8px 10px 7px 14px;
    text-decoration: none;
    display: inline-block;
    color: #666;
    font-family: "Montserrat", sans-serif;
    font-weight: 400;
    font-size: 14px;
    outline: none;
}
.nav-menu  .gr{
  border: 1px solid;
  font-weight: 900;
}

.form-control {
    display: block;
    width: 100%;
    padding: 0.375rem 0.75rem;
    padding: 9px;
    font-size: 1rem;
    line-height: 1.5;
    color: #495057;
    background-color: #fff;
    background-clip: padding-box;
    border: 1px solid #ced4da;
        border-radius: 0.8rem!important;
    transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out;
}
.btn {
    display: inline-block;
    font-weight: 400;
    text-align: center;
    white-space: nowrap;
    vertical-align: middle;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
    border: 1px solid transparent;
    padding: .375rem .75rem;
    font-size: 1rem;
    line-height: 1.5;
    border-radius: .8rem;
    transition: color .15s ease-in-out,background-color .15s ease-in-out,border-color .15s ease-in-out,box-shadow .15s ease-in-out;
}
.input-group-append {
    margin-left: -23px;
    z-index: 99;
}
.form-control:focus {
    color: #495057;
    background-color: #fff;
    border-color: #80bdff;
    outline: 0;
    box-shadow: 0 0 0 0.2rem rgba(255,255,255,255);
}
</style>
@endsection
@section('title')

@endsection

@section('main-content')


  <!--==========================
    Intro Section
  ============================-->
  <section id="drop" class="">
    <div class="container">
      <div class="row pd-top-15">
        <div class="col-sm-12 mt-0">
           
          <h4 class="text-capitalize" ><b> {{ Auth::user()->name }} </b> Group's</h4>
        
        </div>
      </div>
      <hr>
      {{-- <div class="row ">
        <div class="col-sm-6 ml-18 mt-2">
            <div class="input-group mb-3">
              <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search points" title="Type in a name" class="form-control" aria-label="Recipient's username" aria-describedby="basic-addon2">
              <div class="input-group-append">
                <button class="btn btn-outline-secondary" type="button">Search</button>
              </div>
            </div>
        </div> 
      </div> --}}
    
    </div>
    <div class="row" style="margin-top: 63px">
          <div class="col-md-9 ml-5 over-flow">
            <table id="myTable" class="ml-search">
            @foreach($groups as $group)
              <tr >
                <td class="media" style="width: 75%">
                  <i class="fa fa-users group-icon" aria-hidden="true"></i>
                  <a class="drop" href="{{ route('groups.show', $group->id)}}">{{ $group->name }} </a></td>
                <td style="width: 25%"><a  class="red-icon" href="" onclick="
                                  if(confirm('Are sure, you want to delete this?'))
                                  {
                                    event.preventDefault();
                                    document.getElementById('delete-form-{{$group->id}}').submit();
                                  }else
                                  {
                                    event.preventDefault();
                                  }"> &#9940; {{ 'Remove'}}
                    </a>

                    <form id="delete-form-{{$group->id}}" action="{{ route('groups.destroy', $group->id) }}" style="display: none;" method="post">
                      @csrf
                      {{method_field('DELETE')}}
                    </form>
                </td>
                <td><a href="{{ route('groups.edit', $group->id)}}" class="red-icon"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</a></td>
              </tr>
            @endforeach  
            </table>
          </div>
       <div class="col-md-2 search-set">
         <div class="add-drop">  
            <a href="{{ route('groups.create')}}" class="pd-drop">
            <img src="{{URL::asset('img/add.svg')}}" alt=""> </a>
          </div>
       </div>
    </div>
</section><!-- #intro -->


<!-- MODEL OF THE TIMING -->


@endsection 

@section('script-top')
{{-- search functionality --}}
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