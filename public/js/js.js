function validateContactForm() {
    let nom = document.forms["contactForm"]["nom"].value;
    let prenom = document.forms["contactForm"]["prenom"].value;
    let email = document.forms["contactForm"]["email"].value;
    let sujet = document.forms["contactForm"]["sujet"].value;
    let phone = document.forms["contactForm"]["phone"].value;
    let message = document.forms["contactForm"]["message"].value;
    
    if (nom == "") {
        alert("Nom est requis");
        return false;
    } else if(prenom == "") {
        alert("Prenom est requis");
        return false;
    } else if(email == "") {
        alert("Email est requis");
        return false;
    }
    else if(sujet == "") {
        alert("Sujet est requis");
        return false;
    }
    else if(phone == "") {
        alert("Phone est requis");
        return false;
    }
    else if(message == "") {
        alert("Message est requis");
        return false;
    } else {
        alert("Message envoyer, nous vous repondrons dans les breve delais.");
        return false;
    }

}