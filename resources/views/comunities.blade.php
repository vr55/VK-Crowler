@extends( 'layouts.general' )

@section('title')
Список сообществ вконтакте
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

    <h3>Добавить ссылку</h3>
    {{ Form::open() }}
    <div class="input-group">
        {{ Form::label('ссылка на группу вконтакте') }}
        {{ Form::text( 'url', '', ['placeholder' => 'https://vk.com/itcookies'] ) }}
    </div>
    {{ Form::submit( 'Добавить', ['class' =>'btn btn-primary', 'style' => 'margin-top: 10px; margin-bottom: 10px'] ) }}
    {{Form::close() }}
@endsection

@section('content')
    <div class="table-responsive">
      <table class="table table-hover">
        <thead>
            <th>
                id
            </th>
            <th>
                url
            </th>
            <th>
                действие
            </th>
        </thead>
        <tbody>
            @foreach( $comunities as $comunity )
                <tr>
                    <td>
                        {{ $comunity->id }}
                    </td>
                    <td>
                        <div>{{ $comunity->name }}</div>
                        <a style="font-size: 11px" href="{{ $comunity->url }}">{{ $comunity->url }}</a>
                    </td>
                    <td>
                        <a href="#" class="btn btn-danger btn-xs">удалить</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
      </table>
    </div>

    <div class="row">
        <div class="col-md-12">
             {!! $comunities->links() !!}
        </div>
    </div>
@endsection
