@section('footer')

 <!--==========================
    Footer
  ============================-->
  <footer id="footer">
    <div class="container">
      <div class="row">
       
        <div class="col-lg-6">
          <nav class="footer-links  pt-1 pt-lg-0">
            <a href="/policy" class="scrollto">Privacy Policy</a>
            <a href="/help" class="scrollto">Help</a>
            
          </nav>
        </div>
       <div class="col-lg-6 ">
          <div class="footer-img text-lg-right ml-3 ">  
           <img src="{{URL::asset('img/icon_blue.svg')}}" alt="" >
          </div>
          </div>
        </div>
      </div>
    </div>
  </footer><!-- #footer -->

  <a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>
  
@endsection