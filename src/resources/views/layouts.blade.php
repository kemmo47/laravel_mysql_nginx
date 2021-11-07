<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" 
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset('/css/app.css')}}" >
    <title>{{$title}}</title>
</head>
<body>
    <head>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        @if(Session::get('user'))
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="{{asset('/')}}">Home</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{asset('/todo')}}">Todo</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{asset('/logout')}}">LogOut</a>
                            </li>
                        @else
                            <li class="nav-item">
                                <a class="nav-link" href="{{asset('/login')}}">Login</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{asset('/sign-in')}}">SignUp</a>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>
    </head>
    <div class="container">
        <div class="messages-container">
            @if (session('success'))
                <div class="text-success alert"> {{ session('success') }}</div>
            @elseif (session('error'))
                <div class="text-danger alert"> {{ session('error') }}</div>
            @endif
        </div>

        @yield('content')
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" 
        integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" 
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script type="text/javascript">

        $(document).ready(function() {
            window.setTimeout(function () {
                $(".alert").fadeTo(1500, 0).slideUp(500, function () {
                    $(this).remove();
                });
            }, 3000);


            $('#check_all').change(function(){
                if(this.checked){
                    $('.check_todos').prop('checked', true);
                }else {
                    $('.check_todos').prop('checked', false);
                }
            });

            const length_todo = $('.check_todos').length;
            $('.check_todos').change(function() {
                const length_check = $('.check_todos:checked').length;
                if(length_check == length_todo){
                    $('#check_all').prop('checked', true);
                }else{
                    $('#check_all').prop('checked', false);
                }
            })
        })

        function del_all(){
            var data = $('.check_todos:checked');
            var _token = $('input[name="_token"]').val();
            const id = [];
            for(var i = 0; i < data.length; i++){
                id.push(data[i].id.slice(11));
            }
            
            if(id.length > 0){
                $.ajax({
                    url: "/del-all-todos",
                    type: 'POST',
                    data:{id:id,_token:_token},
                    success: function(data) {
                        location.reload()
                    }
                });
            }else{
                Swal.fire('Vui Lòng chọn công việc muốn xóa')
            }
        }

        function done_todos(){
            var data = $('.check_todos:checked');
            var _token = $('input[name="_token"]').val();
            const id = [];
            for(var i = 0; i < data.length; i++){
                id.push(data[i].id.slice(11));
            }
            if(id.length > 0){
                $.ajax({
                    url: "/done-todos",
                    type: 'POST',
                    data:{id:id,_token:_token},
                    success: function(data) {
                        location.reload()
                    }
                });
            }else{
                Swal.fire('Vui Lòng chọn công việc muốn hoàn thành')
            }
        }
  
        function load_todo(){
            var _token = $('input[name="_token"]').val();
            $.ajax({
                url: "/load-todos",
                type: 'POST',
                data:{_token:_token},
                success: function(data) {
                    for(i=0;i<data.length;i++){
                        $('#load_todoss').append(`
                            <tr>
                                <td>${data[i].todo_id}</td>
                                <td>${data[i].todo_info}</td>
                                <td>
                                    <button type="button" onclick="edit_todo('${data[i].todo_info}', '${data[i].todo_id}')" class="me-2 btn btn-secondary">edit</button>
                                    <button type="button" onclick="del_todo(${data[i].todo_id})" class="me-2 btn btn-danger">x</button>
                                </td>
                            </tr>
                        `);
                    }
                }
            });
        }

        function edit_todo(id, info){
            Swal.fire({
                title: 'Edit Todo '+id,
                input: 'text',
                inputValue : info,
                inputAttributes: {
                    autocapitalize: 'off'
                },
                showCancelButton: true,
                confirmButtonText: 'Edit',
                showLoaderOnConfirm: true,
            }).then((result) => {
                if (result.isConfirmed) {
                    if(result.value != ''){
                        var _token = $('input[name="_token"]').val();
                        var info = result.value;
                        $.ajax({
                            url: "/edit-todos",
                            type: 'POST',
                            data:{id:id,info:info,_token:_token},
                            success: function(data) {
                                location.reload();
                            }
                        })
                    }else{
                        Swal.fire('error','Không được để trống', 'warning')
                    }
                }
            })
        }

        function del_todo(id){
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    var _token = $('input[name="_token"]').val();
                    
                    $.ajax({
                        url: "/del-todos",
                        type: 'POST',
                        data:{id:id,_token:_token},
                        success: function(data) {
                            Swal.fire(
                                'Deleted!',
                                'Your file has been deleted.',
                                'success'
                            );
                            setTimeout(function () {
                                window.location.reload(1);
                            }, 500);
                        }
                    })
                }
            })            
        }
        
    </script>
</body>
</html>