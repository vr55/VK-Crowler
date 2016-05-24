<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="/">WebSiteName</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li class="active"><a href="/">Главная</a></li>
        <li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#">Настройки<span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href={{ route( 'settings' ) }}>Общие</a></li>
            <li><a href={{ route( 'comunities' ) }}>Сообщества вконтакте</a></li>
            <li><a href={{ route( 'keywords' ) }}>Ключевые слова</a></li>
            <li><a href={{ route( 'proposal' ) }}>Шаблоны деловых предложений</a></li>
            <li><a href="#">Почта</a></li>
          </ul>
      </li>
        <li><a class="btn btn-primary" style="width: 120px" href="#">Update</a></li>

      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="#"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
        <li><a href="#"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
      </ul>
    </div>
  </div>
</nav>
