<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register</title>
    {{-- <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>--}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<style>
    *{
        font-size: 15px
    }
    form {
        margin: 0px 10px;
    }

    h2 {
        margin-top: px;
        margin-bottom: 40px;
    }

    .container {
        max-width: 450px;
        margin-top: 100px;
        border: 1px solid;
        padding: 2rem;
    }

    .divider {
        text-align: center;
        margin-top: 20px;
        margin-bottom: 5px;
    }

    .divider hr {
        margin: 7px 0px;
        width: 50%;
    }

    .left {
        float: left;
    }

    .right {
        float: right;
    }
</style>

<body>
    <div class="container">
        <div class="row">
            <div class="panel panel-primary">
                @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>{{session('success')}}</strong>
                  </div>
                @endif
                <div class="panel-body">
                    <form method="POST" id="registerform">
                        @csrf
                        <div class="form-group">
                            <h2>Create account</h2>
                        </div>
                        <div class="form-group">
                            <label class="control-label" >Name</label>
                            <input id="name" name="name" type="text" maxlength="50" class="form-control">
                            <p></p>
                        </div>
                        <div class="form-group">
                            <label class="control-label" >Email</label>
                            <input id="email" name="email" type="email" maxlength="50" class="form-control">
                            <p></p>
                        </div>
                        <div class="form-group">
                            <label class="control-label" >Phone</label>
                            <input id="phone" name="phone" type="number" maxlength="10" class="form-control">
                            <p></p>
                        </div>
                        <div class="form-group">
                            <label class="control-label" >Address</label>
                            <input id="address" name="address" type="text" maxlength="25" class="form-control"
                               length="40">
                               <p></p>
                        </div>
                        <div class="form-group">
                            <label class="control-label" >Password</label>
                            <input id="password" name="password" type="password" maxlength="25" class="form-control">
                            <p></p>
                        </div>
                        <div class="form-group">
                            <button id="" type="submit" class="btn btn-success">Register</button>
                        </div>
                        <p></p>Already have an account? <a href="{{route('login')}}">Sign in</a></p>
                    </form>
                </div>
            </div>
        </div>
    </div>

</body>

<script>
    $('#registerform').submit(function(e){
        e.preventDefault();
        $.ajax({
            url:'{{route("registeruser")}}',
            type:'post',
            data:$(this).serializeArray(),
            success:function(response){
                let error=response['error']
                console.log(error)
                if(response['status']==true){
                    location.reload()
                    $('input').removeClass('is-invalid').siblings('p')
                        .removeClass('text-danger').html("")
                }else{

                    $('input').removeClass('is-invalid').siblings('p')
                        .removeClass('text-danger').html("")
                    $.each(error,function(key,value){
                        $(`#${key}`).addClass('is-invalid').siblings('p')
                        .addClass('text-danger').html(value)
                    })
                    
                }
            }
        })
    })
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</html>
