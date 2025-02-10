<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<style></style>
<body>
    @include('sweetalert::alert')

    <div class="text-center border border-5 w-50 m-auto mt-5 pb-5 pt-4 rounded-5 bg-secondary"> 
        <h4>Login To Spatie Role</h4>
        <form action="{{ url('login/action') }}">
            <label class="text-light">Email</label>
            <br>
            <input class="form-control w-25 m-auto" name="email">
            <br>
            <label class="text-light">Password</label>
            <br>
            <input class="form-control w-25 m-auto" name="password">
            <button class="mt-4 btn btn-primary">Sign In</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>