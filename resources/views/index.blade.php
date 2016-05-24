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
        <?php
        //preg_replace($pattern, $replacement, $string);

        //добавляем перенос строки перед элементом нумерованного списка
        $post->text = preg_replace( '/(\d\.)[^\d]/', '<br>$1', $post->text );

        //добавляем перенос строки перед хэш тэгом
        $post->text = preg_replace( '/(#\S*)/', '<br>$1', $post->text );

        //replace http://vk.com/id12356 на кликабельную ссылку
        $post->text = preg_replace( '/(http\S*)/', '<br><a href=$1>$1</a>' , $post->text );

        //replace [id123456|имя] на ссылку на профиль
        $post->text = preg_replace( '/\[(id[\d]*)\|(\S.*)\]/', '<a href="https://vk.com/$1">$2</a>', $post->text );
         ?>

        <div class="panel panel-default">
          <div class="panel-heading">
              <a href="https://vk.com/wall<?php print $post->owner_id . '_' . $post->vk_id?>">{{ $post->owner_name }}</a>
          </div>
          <div style="padding-left: 15px; padding-top:5px">
              @if( date( 'd m Y', $post->date ) == date( 'd m Y' ) )
              <span class="label label-success">новый</span>
              @endif
              <span class="label label-primary">отправлено</span>
          </div>

          <div class="panel-body" style="font-size: 12px; line-height: 1.8">


            <div><?php echo $post->text ?> </div>
          </div>
          <div class="panel-footer">
              <div class="row">
                  <div class="col-md-8" style="font-size: 12px">
                    Дата публикации: {{ date( 'd F Y' ,$post->date )}}
                  </div>
                  <div class="col-md-4">
                    @if( $post->from_id > 0 )
                        <a href="#" class="btn btn-primary btn-xs">отправить сообщение</a>
                    @elseif( $post->signer_id != 0 )
                        <a href="#" class="btn btn-primary btn-xs">отправить сообщение</a>
                    @else
                      <a href="#" class="btn btn-primary btn-xs disabled">невозможно отправить</a>
                    @endif
                    <a href="#" class="btn btn-danger btn-xs">удалить</a>
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
