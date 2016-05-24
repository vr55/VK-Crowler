@extends( 'layouts.general' )

@section('title')
Настройки
@endsection

@section('aside')
    @if ( count( $errors ) > 0 )
        <div class="alert alert-danger">
            <ul>
                @foreach ( $errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
@endsection

@section('content')
{{ Form::model( $settings ) }}
    <div class="table-responsive">
        <h2>Вконтакте</h2>
      <table class="table table-hover table-responsive">
        <tbody>
            <tr>
                <td>
                    {{ Form::label('Вконтакте: id приложения') }}
                </td>
                <td>
                    {{ Form::text( 'client_id', null ) }}
                </td>
            </tr>
            <tr>
                <td>
                    {{ Form::label('Вконтакте: Защищенный ключ') }}
                </td>
                <td>
                    {{ Form::text( 'secret_key', null ) }}
                </td>
            </tr>
            <tr>
                <td>
                    {{ Form::label('Вконтакте: Access Token') }}
                </td>
                <td>
                    {{ Form::text( 'access_token', null ) }}
                    <div>
                        <a target="_blank" href="https://oauth.vk.com/authorize?client_id={{ $settings->client_id }}&display=page&redirect_uri=https://oauth.vk.com/blank.html&scope=offline,messages&response_type=token&v=5.52">получить токен</a>
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                    {{ Form::label( 'Автоматически отправлять сообщения' )}}
                    <div style="font-size:10px; color: #777777; width:250px">приложение будет автоматически отправлять сообщение с деловым предложение пользователю вконтакте
                    </div>
                </td>
                <td>
                    {{ Form::checkbox( 'auto_send' )}}
                </td>
            </tr>
        </tbody>
      </table>

    </div>

    <div class="table-responsive">
        <h2>Почта</h2>
      <table class="table table-hover">
        <tbody>
            <tr>
                <td>
                    {{ Form::label( 'email администратора' ) }}
                    <div style="font-size:10px; color: #777777">на этот email будет отправляться вся информация</div>
                </td>
                <td>
                    {{ Form::text( 'admin_email', null ) }}
                </td>
            </tr>
        </tbody>
    </table>

    </div>
         {{ Form::submit( 'Сохранить', ['class' =>'btn btn-primary', 'style' => 'margin-top: 10px; margin-bottom: 10px'] ) }}
{{ Form::close() }}
@endsection
