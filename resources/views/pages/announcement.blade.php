@extends('layouts.app')

@section('content')
    <script src="{{ asset('property_inventory_theme/html/assets/js/ckeditor.js') }}" type="text/javascript"></script>
    <h3>Announcement</h3>
    <textarea id="editor" placeholder="Compose your announcement here . . ."></textarea>
    
        <div class="page-head">
          <h2 class="page-head-title">Announcements</h2>
        </div>
        <div class="main-content container-fluid">
          <div class="row">
            <div class="col-md-12">
              <ul class="timeline">
                <li class="timeline-item timeline-item-detailed">
                  <div class="timeline-date"><span>June 11, 2016</span></div>
                  <div class="timeline-content">
                    <div class="timeline-avatar"><img src="http://localhost/damas/public/images/229504796089333802020-04-21%2004.14.34%202.jpg" alt="Avatar" class="circle"></div>
                    <div class="timeline-header"><span class="timeline-time">6:25 AM</span><span class="timeline-autor">Jasmyn Delinila </span>
                      <p class="timeline-activity">Mahal talaga kita <a href="#">May Forever</a>.</p>
                      <blockquote class="timeline-blockquote">
                        <p>Quisque condimentum enim nec porttitor egestas. </p>
                        <footer>Aliquam viverra ornare dolor.</footer>
                      </blockquote>
                      <textarea style="margin:15px 0px 0px 0px;padding-left:10px;width:100%;" placeholder="Comment Here . . ."></textarea>
                      <button class="btn btn-primary"><li class="mdi mdi-mail-send"></li> Send</button>
                    </div>
                  </div>
                </li>
                <li class="timeline-item timeline-loadmore"><a href="#" class="load-more-btn">Load more</a></li>
              </ul>
            </div>
          </div>
        </div>
    <script>
        ClassicEditor
        .create( document.querySelector( '#editor' ) )
        .catch( error => {
            console.error( error );
        } );
    </script>
@endsection