@extends( 'layouts.general' )

@section('title')
Главная страница
@endsection

@section('aside')
Главная страница
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            {!! $posts->links() !!}
        </div>
    </div>

    @foreach( $posts as $post )
        <div class="panel panel-default">
          <div class="panel-heading">
              <a target="_blank" href="https://vk.com/wall<?php print $post->owner_id . '_' . $post->vk_id?>">{{ $post->owner_name }}</a>
              @if( date( 'd m Y', $post->date ) == date( 'd m Y' ) )
              <span class="label label-success">сегодня</span>
              @endif
              @if( $post->sent )
                <span class="label label-primary"><span class="glyphicon glyphicon-ok"></span>&nbsp;отправлено</span>
              @endif
              <div style="font-size: 12px; color: #a9a9a9">
                опубликовано: {{ date( 'd F Y' ,$post->date )}}
              </div>
          </div>
          <div style="padding-left: 15px; padding-top:5px">


          </div>

          <div class="panel-body" style="font-size: 12px; line-height: 1.8">


            <div><?php echo $post->text ?> </div>
          </div>
          <div class="panel-footer">
              <div class="row">
                  <div class="col-md-12">
                    @if( $post->from_id > 0 && $post->sent == 0 )
                        <a href={{ route( 'message', $post->from_id ) }} class="btn btn-primary btn-xs">отправить сообщение</a>
                    @elseif( $post->signer_id != 0 && $post->sent == 0 )
                        <a href={{ route( 'message', $post->signer_id )}} class="btn btn-primary btn-xs">отправить сообщение</a>

                    @endif
                    <a href={{ route( 'post.delete', $post->id ) }} class="btn btn-danger btn-xs">удалить</a>
                  </div>

              </div>

          </div>
        </div>


    @endforeach()
    <div class="row">
        <div class="col-md-12">
            {!! $posts->links() !!}
        </div>
    </div>
@endsection
