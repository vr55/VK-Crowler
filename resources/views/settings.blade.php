@extends( 'layouts.general' )

@section('title')
Настройки
@endsection

@section('aside')
@endsection

@section('content')
{{ Form::model( $settings ) }}
    <div class="table-responsive">
        <h2>Вконтакте</h2>
      <table class="table table-responsive">
        <tbody>
            <tr>
                <td>
                    {{ Form::label('Вконтакте: Зарегистрировать новое приложение ') }}
                </td>
                <td>
                    <a target="_blank" href="https://vk.com/apps?act=manage">Ссылка</a>
                </td>
            </tr>
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
                    {!! Form::hidden('send_proposal', '0') !!}
                    {!! Form::checkbox( 'send_proposal', '1' ) !!}
                </td>
            </tr>

            <tr>
                <td colspan="2">
                    <h2>Почта</h2>
                </td>
            </tr>
            <tr>
                <td>
                    {{ Form::label( 'email администратора' ) }}
                    <div style="font-size:10px; color: #777777; width:250px">на этот email будет отправляться вся информация</div>
                </td>
                <td>
                    {{ Form::text( 'admin_email', null ) }}
                </td>
            </tr>

            <tr>
                <td colspan="2">
                    <h2>XMPP/Jabber</h2><span><a href={{ route( 'xmpp' ) }}>проверить</a></span>
                </td>
            </tr>
            <tr>
                <td>
                    {{ Form::label( 'xmpp идентификатор администратора' ) }}
                    <div style="font-size:10px; color: #777777; width:250px">xmpp адрес администратора, на который отправляется информация о новых сообщениях.
                        Зарегистрировать можно на <a target="_blank" href="http://www.jabber.ru">http://www.jabber.ru</a>
                    </div>
                </td>
                <td>
                    <div>{{ Form::text( 'xmpp', null, ['placeholder' => 'myname@jubber.ru'] ) }}</div>
                    <div>{{ Form::text( 'xmpp2', null, ['placeholder' => 'myname@jubber.ru'] ) }}</div>
                    <div>{{ Form::text( 'xmpp3', null, ['placeholder' => 'myname@jubber.ru'] ) }}</div>
                </td>
            </tr>

            <tr>
                <td colspan="2">
                    <h2>Параметры сканирования</h2>
                </td>
            </tr>
            <tr>
                <td>
                    {{ Form::label( 'Глубина сканирования' ) }}
                    <div style="font-size:10px; color: #777777; width:250px">количество последних записей из каждого сообщества, которые будут сканироваться</div>
                </td>
                <td>
                    {{ Form::selectRange( 'scan_depth', 1, 50 ) }}
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <h2>Пользователи</h2>
                </td>
            </tr>
            <tr>
                <td>
                    {{ Form::label( 'Запретить регистрацию' ) }}
                    <div style="font-size:10px; color: #777777; width:250px">Запретить регистрацию новых пользователей</div>
                </td>
                <td>
                    {!! Form::hidden('register_deny', '0') !!}
                    {!! Form::checkbox( 'register_deny', '1' ) !!}
                </td>
            </tr>
        </tbody>
      </table>

    </div>

         {{ Form::submit( 'Сохранить', ['class' =>'btn btn-primary', 'style' => 'margin-top: 10px; margin-bottom: 10px'] ) }}
{{ Form::close() }}
@endsection
