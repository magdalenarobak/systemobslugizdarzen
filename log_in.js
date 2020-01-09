    let pass = document.formularz.pass.value;
    let user = document.formularz.login.value;
    const form = document.getElementById('formularz');
	
	var users = new Array("user1", "user2", "user3");
	var passwords = new Array("kod1", "kod2", "kod3");

	let working = false;
	
	
	function check_pass(user, pass)
	{  
		for(let i = 0; i < users.length; i++){
			if((user == users[i]) && (pass == passwords[i])){
				
				
				return true;
			} else {
				
				return false;
		}

    form.addEventListener('submit', function(e) {
       // $('.formularz').on('submit',function(e) {
		
					e.preventDefault();
					if(working) return;
					working = true;
					let $this = $(this), 
					$state = $this.find('button > .state');
					$this.addClass('loading');
					$state.html('Identyfikacja');
					setTimeout(function() {
						$this.addClass('ok');
						$state.html('Witaj');
						
						setTimeout(function() {
							$state.html('Zaloguj');
							$this.removeClass('ok loading');
							working = false;
						}, 4000);
					}, 3000);
				});
    
        if(check_pass(user, pass)){
		
            console.log(user + " zalogował się");
            window.location.href = "index.html";
            //document.location.href = "index.html";
    

            } else {
            window.alert ("Niepoprawne hasło");
            console.log("Błędne hasło");
            }
	}

    })