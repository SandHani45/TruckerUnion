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
        <form role="form" enctype="multipart/form-data" action="{{route('all-drop-points.update', $drop_point->id)}}" method="post">
            @csrf
            {{ method_field('PATCH') }}
          <div class="row">
              <div class="col-sm-5  ">
                   <div class="drop-circle text-center  img-center">
                  <div class="image-holder rounded-circle">
                    <img id="imgSrc" src="{{$drop_point->image}} " style="">
                  </div>
                  <label class="custom-file">
                    <input id="contactImg" type="file" name="image" class="custom-file-input" data-input="false" data-btnClass="btn-primary" accept="image/*" value="{{$drop_point->image}}">
                  </label>
                </div>
              </div>
            <div class="col-sm-7">
              <div class="row col-sm-12">
                <div class="col-sm-12">
                  <label for=""> Name of Drop off point</label>
                   <input type="text" name="name" id="name" class="form-control" placeholder="" required="" value="{{ $drop_point->name }}" maxlength="30">
                </div>
                 <div class="col-sm-12">
                    <br>
                  <label for=""> Search Drop Off Point</label>
                  <input type="text" name="address" id="searchmap" class="form-control" value="{{ $drop_point->address }}" required="">   
                </div>  
                <br>
                <br>
                <div class="col-sm-12 mt-3">
                 <div id="map-canvas" style="width: 575px;height: 273px;position: relative;overflow: hidden;"></div>
                </div>  
                
                <div class="col-sm-12">
                {{--   <label for=""> lat</label> --}}
                  <input type="hidden" name="latitude" id="lat" class="form-control"  value="{{ $drop_point->latitude }}">
                  
                </div> 
                <div class="col-sm-12">
                 {{--  <label for=""> lng</label> --}}
                  <input type="hidden" name="longitude" id="lng" class="form-control" value="{{ $drop_point->longitude }}"  >
                </div>   
              </div>
              <br>
            </div>
          </div>
          <hr>
          <div class="row ">
            <div class="col-sm-5 mt-2">
              <h5 class="ml-40p">Worenannahme-zeiten</h5>
            </div> 
          </div>
           @foreach ($timings as $timing)
           <div class="row ml-6p" style="">
              <div class="col-md-4 ml-13">
                <div class="row">
                  <div class="col-sm-3"><p class="font-weight-bold">{{ $timing->day }}</p></div>
                  <div class="col-sm-2"><input  type="time" id="start_time" name="{{ $timing->day }}_start_time" class="" value="{{ $timing->start_time }}"> </div>
                  <div class="col-sm-2 ml-5"> <input  type="time" id="mo_end_time" name="{{ $timing->day }}_end_time" class="" value="{{ $timing->end_time }}"></div>
                </div>
              </div>
              <div class="col-md-4">
                 <div class="row">
                   <div class="col-sm-3"><p class="font-weight-bold">Lunch</p></div>
                    <div class="col-sm-2"><input  type="time" id="lunch_mo_start_time" name="{{ $timing->day }}_lunch_start_time" class="" value="{{ $timing->lunch_start_time }}"> </div>
                <div class="col-sm-2 ml-5"> <input  type="time" id="lunch_mo_end_time" name="{{ $timing->day }}_lunch_end_time" class="" value="{{ $timing->lunch_end_time }}"></div>
                 </div>
              </div>
           </div>
          @endforeach 
          <hr>
          <div class="row mt-24">
            <div class="col-sm-5 cont-flex"> 
              <h5 class="ml-40p mt-1">Telefon</h5>
            </div>
            <div class="col-sm-3 ml-5">
              <input type="text" name="phone_number" id="phone_number" onkeypress="phoneno()" class="form-control" placeholder="+49" value="{{ $drop_point->phone_number }}" maxlength="12" >
            </div>
            <div class="col-sm-3">
              <label class="switch mt-1">
                <p class="swich-pera">Show in app</p>
                <input name="show_in_app" id="show_in_app" type="checkbox" 
                @if( $drop_point->show_in_app == 1) 

              checked

                @endif>
                <span class="slider round"></span>
              </label>
            </div>
          </div>
          <hr>  
          <div class="row">
            <div class="col-sm-5">
              <h5 class="ml-40p mt-1 center-pera">Sonderforderungen</h5>
            </div>
            <div class="col-sm-3 ml-5 mt-1">
              <p class="center-pera">Rampe vorhanden?</p>
            </div>
            <div class="col-sm-2">
              <label class="switch mt-1">
                <input name="rampe" type="checkbox" {{ $drop_point->rampe }}
                 @if( $drop_point->rampe == 1) 

              checked

                @endif>

                <span class="slider round"></span>
              </label>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-5"> 
              <h5 class="ml-40p mt-1"></h5>
            </div>
            <div class="col-sm-3 ml-5 mt-1">
              <p class="center-pera">Stapler vorhanden?</p>
            </div>
            <div class="col-sm-2">
              <label class="switch mt-1">
                <input name="crane" id="crane" type="checkbox" onclick="myFunction()" value="{{ $drop_point->crane }}" 
                @if( $drop_point->crane == 1) 
                checked
                @endif >
                <span class="slider round"></span>
                </label>
            </div>
          </div>

           <div class="row" id="show_craner" style="display: none;">
            <div class="col-sm-5"> 
              <h5 class="float-right-a mt-1"></h5>
            </div>
            <div class="col-sm-3 ml-5 mt-1">
              <p>Staplerbezeichnung</p>
            </div>
            <div class="col-sm-2">
              <label class=" mt-1">
                <input id="craner_type" name="craner_type" type="text" class="form-control" value="{{ $drop_point->craner_type }}">
                </label>
            </div>
          </div>

          <div class="row">
            <div class="col-sm-5">
              <h5 class="float-right-a mt-1"></h5>
            </div>
            <div class="col-sm-3 ml-5 mt-1">
              <p class="center-pera">special_requirement</p>
            </div>
            <div class="col-sm-2">
              <label name="special_requirement" class="switch mt-1" >
                <input type="checkbox" value="{{ $drop_point->special_requirement }}" 
                 @if( $drop_point->special_requirement == 1) 

              checked

                @endif
                >
                  <span class="slider round"></span>
              </label>
            </div>
          </div>
          <div class="row" >
            <div class="col-sm-5"> 
              <h5 class="float-right-a mt-1"></h5>
            </div>
            <div class="col-sm-3 ml-5 mt-1">
              <p class="text-capitalize">Maximum Height for trucks</p>
            </div>
            <div class="col-sm-2">
              <label class=" mt-1">
                <input id="m_hight" name="m_hight" type="number" class="form-control" step="any" value="{{ $drop_point->m_hight }}">
              </label>
            </div>
          </div>
            <div class="row">
              <div class="col-sm-5 col-md-5">
                <h5 class="ml-40p mt-1 text-capitalize">Enough space for </h5>
              </div>
              <div class="col-sm-5 col-md-5 ml-5">
                  <div class="row">
                    <div class="col-sm-5">
                      <img src="{{URL::asset('img/truck/01.PNG')}}" alt="" width="100%">
                    </div>
                    <div class="col-sm-5 flex flex-end">
                       <div class="checkdiv grey400">
                        <input id="rampe_small" name="rampe_small" type="checkbox" class="le-checkbox" value="{{ $drop_point->rampe_small }}" 
                        @if($drop_point->rampe_small == 1) 
                            checked
                        @endif
                      />
                      </div>
                    </div>
                  </div>
                  <div class="row mt-2">
                    <div class="col-sm-5">
                       <img src="{{URL::asset('img/truck/02.PNG')}}" alt="" width="100%" >
                        
                    </div>
                    <div class="col-sm-5 flex flex-end">
                      <div class="checkdiv grey400">
                        <input id="rampe_medium" name="rampe_medium" type="checkbox" class="le-checkbox" value="{{ $drop_point->rampe_medium }}"
                           @if($drop_point->rampe_medium == 1) 
                            checked
                            @endif 
                        />
                      </div>
                    </div>
                  </div>
                  <div class="row mt-4 ">
                    <div class="col-sm-5">
                       <img src="{{URL::asset('img/truck/03.PNG')}}" alt="" width="100%">
                    </div>
                    <div class="col-sm-5 flex flex-end">
                      <div class="checkdiv grey400">
                        <input id="rampe_big" name="rampe_big" type="checkbox" class="le-checkbox" value="{{ $drop_point->rampe_big }}"
                          @if($drop_point->rampe_big == 1) 
                            checked
                          @endif 
                        />
                      </div>
                    </div>
                  </div>  
              </div>
            </div>
          <div class="row">
            <div class="col-sm-5">
              <h5 class="ml-40p mt-1 ">Message to the drivers</h5>
            </div>
            <div class="col-sm-5 ml-5 mt-1">
              <textarea name="driver_message" id="driver_message" cols="50" rows="5" >{{$drop_point->driver_message }}</textarea>
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

<!-- Drop-Toggile -->
<script>
  $(document).ready(function(){
    if({{ $drop_point->crane }}){
      document.getElementById("show_craner").style.display = "flex";
    }
  })
    function myFunction() {
      var checkBox = document.getElementById("crane");
      var text = document.getElementById("show_craner");
      if (checkBox.checked == true){
          text.style.display = "flex";
      } else {
         $('#craner_type').val('')
         text.style.display = "none";
      }
    }
</script>

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