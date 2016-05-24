@extends( 'layouts.general' )

@section('title')
Управление ключевыми словами
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

    <h3>Добавить ключ</h3>
    {{ Form::open() }}
    <div class="input-group">
        {{ Form::label('ключевое слово') }}
        {{ Form::text( 'keyword', '', ['placeholder' => 'видео'] ) }}
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
            @foreach( $keywords as $word )
                <tr>
                    <td>
                        {{ $word->id }}
                    </td>
                    <td>
                        {{ $word->keyword }}
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
             {!! $keywords->links() !!}
        </div>

    </div>
@endsection
