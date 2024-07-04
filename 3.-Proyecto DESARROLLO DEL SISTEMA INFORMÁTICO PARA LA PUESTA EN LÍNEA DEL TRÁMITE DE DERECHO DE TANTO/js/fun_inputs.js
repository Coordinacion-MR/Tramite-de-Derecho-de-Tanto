// Función para permitir solo la entrada de números
function numeros(event) {
    // Obtiene el código de la tecla presionada
    var letra = event.keyCode; 
    
    // Permite solo números (códigos de 48 a 57) y la tecla de retroceso (código 8)
    if ((letra >= 48 && letra <= 57) || (letra === 8)) {
        return true;
    } else {
        return false;
    }
}

// Función para permitir solo la entrada de letras
function letras(event) {
    // Obtiene el valor de la tecla presionada
    var tecla = event.key;
    // Expresión regular para permitir solo letras y la tecla de retroceso
    var parametro = /^[a-zA-Z\b]+$/;
    // Prueba si la tecla presionada cumple con la expresión regular
    return parametro.test(tecla);
}

// Función para permitir la entrada de letras y números
function letrasynumeros(event) {
    // Obtiene el código de la tecla presionada
    var letra = event.keyCode; 
    // Expresión regular para permitir solo letras y la tecla de retroceso
    var parametro = /^[a-zA-Z\b]+$/;

    // Permite números (códigos de 48 a 57)
    if (letra >= 48 && letra <= 57) {
        return true;
    }
    // Obtiene el valor de la tecla presionada
    letra = event.key;
    // Prueba si la tecla presionada cumple con la expresión regular
    if (parametro.test(letra)) {
        return true;
    } else {
        return false;
    }
}

// Función para alternar la visibilidad de la contraseña
function toggleMostrarContrasena() {
    // Obtiene el campo de entrada de la contraseña por su ID
    var inputContrasena = document.getElementById("ContrasenaIng");
    // Alterna el tipo del campo entre 'password' y 'text'
    if (inputContrasena.type === "password") {
        inputContrasena.type = "text";
    } else {
        inputContrasena.type = "password";
    }
}