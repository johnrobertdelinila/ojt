@extends('layouts.app')

@section('content')
    <script src="{{ asset('property_inventory_theme/html/assets/js/ckeditor.js') }}" type="text/javascript"></script>
    
    @if(Auth::user()->utype == 'admin' || Auth::user()->utype == 'rd')
      <h3>New task</h3>
      <form method="post" action="classwork_reg">
        {{ csrf_field() }}
        <textarea rows='8' name="description" id="editor" placeholder="Compose your classwork here . . ."></textarea>
        
        <br>
        <button type="submit" class="btn btn-warning"><li class="mdi mdi-mail-send"></li> Post Task</button>
      </form>
    @endif
    
        <div class="page-head">
          <h2 class="page-head-title">Classworks</h2>
        </div>
        <div class="main-content container-fluid">
        @foreach($classworks as $classwork)
          <div class="row">
            <div class="col-md-12">
              <ul class="timeline">
                <li class="timeline-item timeline-item-detailed">
                  <div class="timeline-date"><span>{{ date("F d, Y", strtotime($classwork->created_at)) }}</span></div>
                  <div class="timeline-content">
                    <div class="timeline-avatar"><img src="{{ $classwork->user->image_photo != null ? url('images/' . $classwork->user->image_photo) : url('property_inventory_theme/html/assets/img/avatar1.png')  }}" alt="Avatar" class="circle"></div>
                    <div class="timeline-header"><span class="timeline-time">{{ date("h:i A", strtotime($classwork->created_at)) }}</span><span class="timeline-autor">{{ $classwork->user->name }}</span>
                      <!-- <p class="timeline-activity">Title: <a href="#">{{ $classwork->title }}</a>.</p> -->
                      <blockquote class="timeline-blockquote">
                        {!! $classwork->description !!}
                        <footer>{{ date("l", strtotime($classwork->created_at)) }}</footer>
                      </blockquote>
                      <!-- <textarea style="margin:15px 0px 0px 0px;padding-left:10px;width:100%;" placeholder="Comment Here . . ."></textarea> -->
                      <br>
                      <a href="{{url('/classwork_detail/' . $classwork->id)}}"><button type="button" class="btn btn-primary"><li class="mdi mdi-eye"></li> Show</button></a>
                    </div>
                  </div>
                </li>
                <!-- <li class="timeline-item timeline-loadmore"><a href="#" class="load-more-btn">Load more</a></li> -->
              </ul>
            </div>
          </div>
        @endforeach
        </div>
    <script>
        ClassicEditor
        .create( document.querySelector( '#editor' ) )
        .catch( error => {
            console.error( error );
        } );
    </script>
@endsection