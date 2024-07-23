<!DOCTYPE html>
<html>
<head>
    <title>My Web Page</title>
    <style>
        header {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
        }
        
        .login-box {
            width: 500px;
            margin: 100px auto;
            padding: 20px;
            background-color: #16165F;
            border: none;
            color: white;
            input {
                display: block;
                margin-bottom: 10px;
                padding: 5px;
                width: 100%;
                border: none;
                border-bottom: 1px solid black;
            }
            .input-container {
                display: flex; 
                flex-direction: row;
                label {
                    width: 220px;
                }
            }
            .submit {
                background-color: #6959AD;
                color: white;
            }
            
            .submit:hover {
                background-color: rgb(44, 44, 117);
            }
        }
    </style>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}">
</head>
<body>
    @include('components.header')
    
    <form class="login-box" method="post" action="login_attempt">
        @csrf
        <h2>Log in</h2>
        <div>
            <div class="input-container">
                <label for="email">Email:</label>
                <input type="email" name="email" placeholder="Email">
            </div>
            <div class="input-container">
                <label for="password">Password:</label>
                <input type="password" name="password" placeholder="Password">
            </div>
        </div>
        <input type="submit" value="Submit" class="submit">
    </form>

    <form class="login-box" method="post" action="register_user">
        @csrf
        <h2>Register</h2>
        <div>
            <div class="input-container">
                <label for="name">Name:</label>
                <input type="text" name="name" placeholder="Name">
            </div>
            <div class="input-container">
                <label for="email">Email:</label>
                <input type="email" name="email" placeholder="Email">
            </div>
            <div class="input-container">
                <label for="password">Password:</label>
                <input type="password" name="password" placeholder="Password">
            </div>
            <div class="input-container">
                <label for="confirm_password">Confirm Password:</label>
                <input type="password" name="confirm_password" placeholder="Confirm Password">
            </div>
        </div>
        <input type="submit" value="Submit" class="submit">
    </form>
    @include('components.footer')
</body>
</html>