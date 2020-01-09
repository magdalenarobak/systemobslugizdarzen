
    let pass = document.getElementById('pass');
    let user = document.getElementById('login');
    const form = document.getElementById('formularz');

    let testuser = "test";
    let testpass = "123";

    form.addEventListener('submit', function() {
        
        
        if (user.value == testuser){
        
            if(pass.value == testpass){
            console.log(user.value + " zalogował się");
            window.location.href = 'index.html';
            return
    

            } else {
            window.alert ("Niepoprawne hasło");
            console.log("Błędne hasło");
            }

        } else {
        window.alert ("Niepoprawny login");
        console.log ("Błędny login");

        }


    })

    

