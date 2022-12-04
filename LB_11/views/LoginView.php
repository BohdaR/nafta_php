<?php
class LoginView {
    public function print(){
        return '<html>
            <head>
                <title>Login page</title>
            </head>
            <body>
                <h1>Enter login data</h1>
                <form method="POST" action="">
                    <input type="text" name="login" required placeholder="Enter login"/></br>
                    <input type="password" name="password" required placeholder="Enter password"/></br>
                    <input type="submit" value="Login"/>
                </form>
            </body>
        </html>';
    }
}
