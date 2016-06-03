<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>

      <a class="navbar-brand" href="/"><img style="display: inline; margin-top: -15px" src="http://www.monochromatic.ru/mc_logo32.png" alt="monochromatic logo" />
         <span> VK&nbsp;Crawler <span style="font-size: 10px">v0.1b</span>
            <div style="font-size:10px; margin-top:-7px;">by monochromatic</div>
        </span>
    </a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li class="active"><a href="/">Главная</a></li>
        @if( Sentinel::check() )
            <li class="dropdown">
              <a class="dropdown-toggle" data-toggle="dropdown" href="#">Настройки<span class="caret"></span></a>

              <ul class="dropdown-menu">
                <li><a href={{ route( 'settings' ) }}>Общие</a></li>
                <li><a href={{ route( 'comunities' ) }}>Сообщества вконтакте</a></li>
                <li><a href={{ route( 'keywords' ) }}>Ключевые слова</a></li>
                <li><a href={{ route( 'proposal' ) }}>Шаблоны деловых предложений</a></li>
              </ul>

          </li>
            <a style="margin-top:10px; width: 200px" class="btn btn-primary" style="width: 120px" href={{ route( 'update' ) }}>Update</a>
        @endif
      </ul>
      <ul class="nav navbar-nav navbar-right">
        @if( Sentinel::check() )
            <li><a href={{ route( 'logout' ) }}><span class="glyphicon glyphicon-log-out"></span> Выход</a></li>
        @else
            <li><a href={{ route( 'register' ) }}><span class="glyphicon glyphicon-user"></span> Регистрация</a></li>
            <li><a href={{ route( 'login' ) }}><span class="glyphicon glyphicon-log-in"></span> Вход</a></li>
        @endif
      </ul>
    </div>
  </div>
</nav>
