<nav class="navbar navbar-default navbar-static-top">
    <div class="container">
        <div class="navbar-header">

            <!-- Collapsed Hamburger -->
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                <span class="sr-only">Toggle Navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

            <!-- Branding Image -->
            <a class="navbar-brand" href="{{ url('/') }}">
                {{ config('app.name', 'Laravel') }}
            </a>
        </div>

        <div class="collapse navbar-collapse" id="app-navbar-collapse">
            <!-- Left Side Of Navbar -->
            <ul class="nav navbar-nav">
                &nbsp;
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="nav navbar-nav navbar-right">
                <!-- Authentication Links -->
                @if (Auth::guest())
                    <li><a href="{{ url('/login') }}">Login</a></li>
                    <li><a href="#" data-toggle="modal" data-target="#registerModal">Register</a></li>
                @else
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu" role="menu">
                            <li>
                                <a href="{{ url('/logout') }}"
                                    onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                    Logout
                                </a>

                                <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </li>
                        </ul>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>

<!-- AB : Modal for registration -->
<div class="modal fade" hidden="true" id="registerModal" role="dialog" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="panel panel-filled">
                <div class="panel-body">
                    <form action="{{url('/register')}}" id="registerForm" method="post" name="registerForm">
                        <div class="form-group" id="register-name">
                            <label class="control-label" for="name">Name</label>
                            <input class="form-control" id="name" name="name" placeholder="choose name" required="" title="Please enter you name" type="text">
                            <span class="help-block"><strong id="register-errors-name"></strong></span><span class="help-block small"></span>
                        </div>
                        <div class="form-group" id="register-email">
                            {{ csrf_field() }}
                            <label class="control-label" for="email">Email</label>
                            <input class="form-control" id="email" name="email" placeholder="example@gmail.com" required="" title="Please enter you email" type="email"  value="">
                            <span class="help-block"><strong id="register-errors-email"></strong></span> <span class="help-block small"></span>
                        </div>
                        <div class="form-group" id="register-password">
                            <label class="control-label" for="password">Password</label>
                            <input class="form-control" id="password" name="password" placeholder="******" required="" title="Please enter your password" type="password" value="">
                            <span class="help-block"><strong id="register-errors-password"></strong></span> <span class="help-block small"></span>
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="password-confirm">Confirm Password</label>
                            <input class="form-control" id="password-confirm" name="password_confirmation" placeholder="******" type="password">
                            <span class="help-block"><strong id="form-errors-password-confirm"></strong></span>
                        </div>
                        <div class="form-group" id="login-errors">
                            <span class="help-block"><strong id="form-login-errors"></strong></span>
                        </div>
                        <div>
                            <button class="btn btn-login right">Register</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function(){
        var registerForm = $("#registerForm");
        registerForm.submit(function(e){
            e.preventDefault();
            var formData = registerForm.serialize();
            $( '#register-errors-name' ).html( "" );
            $( '#register-errors-email' ).html( "" );
            $( '#register-errors-password' ).html( "" );
            $("#register-name").removeClass("has-error");
            $("#register-email").removeClass("has-error");
            $("#register-password").removeClass("has-error");

            $.ajax({
                url:'/register',
                type:'POST',
                data:formData,
                success:function(data){
                    $('#registerModal').modal( 'hide' );
                    location.reload(true);
                },
                error: function (data) {
                    console.log(data.responseText);
                    var obj = jQuery.parseJSON( data.responseText );
                   if(obj.name){
                        $("#register-name").addClass("has-error");
                        $( '#register-errors-name' ).html( obj.name );
                    }
                    if(obj.email){
                        $("#register-email").addClass("has-error");
                        $( '#register-errors-email' ).html( obj.email );
                    }
                    if(obj.password){
                        $("#register-password").addClass("has-error");
                        $( '#register-errors-password' ).html( obj.password );
                    }
                }
            });
        });
    });
</script>
