<?php

include('session.php');

require_once("Authentication.php");

$auth = new Authentication();
?>

<html lang="en">
    <head>
        <title>Basic Cookie Auth</title>
    </head>
    <body>
        <script>
            document.addEventListener("DOMContentLoaded", (event) => {
                const loginForm = document.getElementById("login-form")
                const formErrors  = document.getElementById("form-errors")
                const emailInput = document.getElementById("email")
                const passwordInput = document.getElementById("password")

                loginForm.addEventListener("submit", (event) => {
                    event.preventDefault()

                    login()
                })

                async function login()
                {
                    const result = await fetch("login.php", {
                        method: "POST",
                        body: JSON.stringify({
                            email: emailInput.value,
                            password: passwordInput.value
                        }),
                        headers: {
                            "Content-Type": "application/json",
                            "Accept": "application/json"
                        }
                    })

                    const json = await result.json()

                    if(result.status !== 200) {
                        let errors = ""

                        json.errors.map((error) => {
                            errors += `<span>${error}</span>`
                        })

                        formErrors.innerHTML = errors;

                        return;
                    }

                    window.location.replace("/dashboard.php");
                }
            })
        </script>
        <div>
            <form method="post" action="/login" id="login-form">
                <div id="form-errors">
                </div>
                <div>
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" maxlength="255" required>
                </div>
                <div>
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" maxlength="255" required>
                </div>
                <button type="submit">Login</button>
            </form>
        </div>
    </body>
</html>