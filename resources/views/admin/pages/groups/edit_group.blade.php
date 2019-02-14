@extends('admin.master')

@include('admin.layouts.header')

@include('layouts.footer')

@section('style')

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC15JES1HHosGZrXL50q0xnEVQcecfaQj8&libraries=places"></script>

<style type="text/css">
    section{
        background: #f2f2f2;
    }

    #header .scrollto p{
        background: url('../../img/icon_blue.svg') repeat 0 0;  
        height: 73px;
        width: 150px;
    }

    #header.header-fixed  .scrollto p{
      background: url('../../img/icon.svg') repeat 0 0;
      height: 73px;
      width: 150px;
    }

</style>

@endsection
@section('title')
@endsection

@section('main-content')
<main id="main">
  <section> 
    <div class="container"> 
        <div class="row pd-top-15">
            <div class="col-sm-12 mt-0">
              <h4><b>Enter the Details </b>of your Drop-off point</h4>            
            </div>
        </div>
        <hr>
        <form role="form" enctype="multipart/form-data" action="{{route('groups.update', $groups->id)}}" method="post">
            @csrf
            {{ method_field('PATCH') }}
          <div class="row mb-5">
              <div class="col-sm-5 ">
                   <div class="drop-circle text-center  img-center">
                  <div class="image-holder rounded-circle">
                    <img id="imgSrc" src="{{$groups->image}} " style="">
                  </div>
                  <label class="custom-file">
                    <input id="contactImg" type="file" name="image" class="custom-file-input" data-input="false" data-btnClass="btn-primary" accept="image/*" value="{{$groups->image}}">
                  </label>
                </div>
              </div>
            <div class="col-sm-7">
              <div class="row col-sm-7 mt-5">
                <div class="col-sm-12">
                  <label for=""> Name of Chat Group</label>
                   <input type="text" name="name" id="name" class="form-control" placeholder="" required="" value="{{ $groups->name }}" maxlength="30">
                </div>
              </div>
             {{--   <div class="col-sm-7 mt-3">
                  <label for=""> Password</label>
                  <input type="password" name="password" id="password" class="form-control" value="{{ $groups->password }}">
                </div>  --}}
              <br>
            </div>
          </div>
          <hr>


          <div class="row">
          <div class="col-sm-12 ml-center">
            <button type="submit" id="addButton" value="Submit" class="ml-5 btn-css btn-lg btn-primary btn-block center-block" >Save</button>
          </div>
         </div>
        </form>
      </div>
  </section> 
</main>
@endsection

@section('script-top')


<script type="text/javascript">
   
     //image preview
    $("#contactImg").on('change', function () {
        if (typeof (FileReader) != "undefined") {

            var image_holder = $(".image-holder");
            image_holder.empty();

            var reader = new FileReader();
            reader.onload = function (e) {
                $("<img />", {
                    "src": e.target.result
                }).appendTo(image_holder);

            }
            image_holder.show();
            reader.readAsDataURL($(this)[0].files[0]);
        } else {
            alert("This browser does not support FileReader.");
        }
    });

 // SEARCH DROP-POINTS LOCATION 

var map = new google.maps.Map(document.getElementById('map-canvas'),{
  center:{
    lat:27.72,
    lng:85.26
  },
  zoom:15
});

var marker = new google.maps.Marker({
   position:{
    lat:27.72,
    lng:85.26
  },
  map:map,
  draggable:true
});
// Create the search box and link it to the UI element.
var searchBox = new google.maps.places.SearchBox( document.getElementById('searchmap'));
    google.maps.event.addListener(searchBox,'places_changed',function(){
       var places = searchBox.getPlaces();
       var bounds = new google.maps.LatLngBounds();
       var i, place;
        for(i=0; place=places[i];i++){
          bounds.extend(place.geometry.location);
          marker.setPosition(place.geometry.location); //set marker postion new
        }
        map.fitBounds(bounds);
        map.setZoom(15);
    });
      
    google.maps.event.addListener(marker,'position_changed', function(){

        var lat = marker.getPosition().lat();
        var lng = marker.getPosition().lng();

        $('#lat').val(lat);
        $('#lng').val(lng);
    }); 
  
</script>
<!-- Mobile number validation -->
<script>        
  function phoneno(){          
      $('#phone_number').keypress(function(e) {
          var a = [];
          var k = e.which;

          for (i = 48; i < 58; i++)
              a.push(i);

          if (!(a.indexOf(k)>=0))
              e.preventDefault();
      });
  }
</script>

@endsection