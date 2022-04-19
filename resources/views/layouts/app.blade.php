<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>
                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
$(document).ready(function(){


///////##################################3  display employee records ######################3

function show_employees()
    {
        $.ajax({
            url:"{{url('employee')}}",
            method:"get",
            data:{},
            success:function(data)
            {
                
                var html='';
                var i=0;
                for(x of data)
                {
                    i++;
                     html +='<tr><th scope="row">'+i+'</th><td>'+x.first_name+'</td><td>'+x.last_name+'</td><td>'+x.name+'</td><td>'+x.email+'</td><td>'+x.phone+'</td><td><button type="button" class="btn btn-primary editt_employee"  data-id="'+x.id+'">edit</button>&nbsp;&nbsp;<button type="button" class="btn btn-danger delete_employee"  data-id="'+x.id+'">delete</button></td></tr>';
                }
                $('#employee_table').html(html);
                //console.log(html);
            }
        });
    }


///######################################  insert employee data ###############################////

    $(document).on("click",'.add_employee',function(e){
        e.preventDefault();
       var first_name = $("#first_name").val();
       var last_name = $("#last_name").val();
       var company = $("select#company option").filter(":selected").val();
       //alert(company);
       var email = $("#email").val();
       var phone = $("#phone").val();
        $.ajax({
            url:"{{url('employee')}}",
            method:"post",
            data:{first_name:first_name,last_name:last_name,company:company,email:email,phone:phone,'_token':"{{ csrf_token() }}"},
            success:function(data)
            {
                console.log(data);
                
                $('#employeeadd').modal('hide');
                $('#employeeform').trigger("reset");
            },
            error: function (err) {
                if (err.status == 422) { 
                    console.log(err.responseJSON);
                    $.each(err.responseJSON.errors, function (i, error) {
                        var el = $(document).find('[id="'+i+'"]');
                        el.after($('<span style="color: red;">'+error[0]+'</span>'));
                    });
                }
            }
            
        });
        show_employees();
    });



    ///////#################################### edit employee data ################################////

    $(".edit_employee").on("click",function(){
       var id = $("#hidden_id").val();
       var first_name = $("#first_name1").val();
       var last_name = $("#last_name1").val();
       var company = $("select#company1 option").filter(":selected").val();
       //alert(company);
       var email = $("#email1").val();
       var phone = $("#phone1").val();
        $.ajax({
            url:"{{url('employee')}}/"+id,
            method:"put",
            data:{first_name:first_name,last_name:last_name,company:company,email:email,phone:phone,'_token':"{{ csrf_token() }}"},
            success:function(data)
            {
                console.log(data);
                $('#editemployee').modal('hide');
            },
            error: function (err) {
                if (err.status == 422) { 
                    console.log(err.responseJSON);
                    $.each(err.responseJSON.errors, function (i, error) {
                        var el = $(document).find('[id="'+i+'1'+'"]');
                        el.after($('<span style="color: red;">'+error[0]+'</span>'));
                    });
                }
            }
            
        });
        show_employees();
    });



    show_employees();
    
    ////////###########################  displya data in modal for update ###################
    $(document).on("click",".editt_employee",function(){
        var id = $(this).data('id');
        $.ajax({
            url:"{{url('employee')}}/"+id,
            method:"get",
            data:{},
            success:function(data)
            {
                $("#first_name1").val(data.first_name);
                $("#hidden_id").val(data.id);
                $("#last_name1").val(data.last_name);
                $("#company1").val(data.company);
                $("#email1").val(data.email);
                $("#phone1").val(data.phone);
                $("#editemployee").modal('show');
                //console.log(data);
            }
        });
        
    });

//////###############################3  delete employee record #######################
    $(document).on("click",'.delete_employee',function(){
       var id = $(this).data('id');
       //alert(id);
        $.ajax({
            url:"{{url('employee_destroy')}}/"+id,
            method:"get",
            data:{},
            success:function(data)
            {
                console.log(data);
                //$('#editemployee').modal('hide');
            }
            
        });
        show_employees();
    });


    $(document).on('click','.show_add_employee',function(e){
        //e.preventDefault();
        $('#employeeadd').modal('show');
    })


});
</script>
</body>
</html>
