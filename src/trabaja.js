document.addEventListener('DOMContentLoaded', function() {
    const telefono = document.getElementById('telefono');
    const nombreApellido = document.getElementById('nombre-apellido');
    const numeroDocumento = document.getElementById('numero-documento')
    const inputHojaVida = document.getElementById('hoja-vida');
    
    // Escuchar el evento de entrada para limpiar el mensaje de error
    telefono.addEventListener('input', function() {
        telefono.setCustomValidity(''); // Restablecer la validación al ingresar un nuevo valor
    });

       // Escuchar el evento de entrada para limpiar el mensaje de error en nombre y apellido
       nombreApellido.addEventListener('input', function() {
        nombreApellido.setCustomValidity(''); // Restablecer la validación al ingresar un nuevo valor
    });

    // documento
    numeroDocumento.addEventListener('input', function() {
        numeroDocumento.setCustomValidity(''); 
    });

     // Escuchar el evento de entrada para limpiar el mensaje de error en la hoja de vida
     inputHojaVida.addEventListener('change', function() {
        inputHojaVida.setCustomValidity(''); // Restablecer la validación al seleccionar un nuevo archivo
    });



    document.getElementById('miformacion').addEventListener('submit', function(event) {
        const telefonoLimpiado = telefono.value.replace(/\D/g, ''); // Eliminar todos los caracteres no numéricos
        const telefonoValido = /^(3\d{9}|[1-9]\d{6}|\d{10})$/; // Expresión regular para números válidos en Colombia

        // Validar el teléfono
        if (!telefonoValido.test(telefonoLimpiado)) {
            telefono.setCustomValidity('Por favor, ingrese un número de teléfono válido de Colombia.');
            telefono.reportValidity(); // Mostrar el mensaje de validación personalizado
            event.preventDefault();  // Evita que el formulario se envíe si la validación falla
        } else {
            telefono.setCustomValidity(''); // Restablecer la validación si el número es válido
        }

        // Validación del nombre y apellido
        const nombreApellidoValido = /^[A-Za-záéíóúÁÉÍÓÚüÜñÑ\s]+$/; // Expresión regular para letras y espacios

        // Validar el nombre y apellido
        if (!nombreApellidoValido.test(nombreApellido.value)) {
            nombreApellido.setCustomValidity('Por favor, ingrese solo letras y espacios.');
            nombreApellido.reportValidity(); // Mostrar el mensaje de validación personalizado
            event.preventDefault();  // Evita que el formulario se envíe si la validación falla
        } else {
            nombreApellido.setCustomValidity(''); // Restablecer la validación si el nombre es válido
        }

        // Validación del número de documento
        const documentoValido = /^\d{5,10}$/; // Aceptar números de documento entre 5 y 10 dígitos

        // Validar el número de documento
        if (!documentoValido.test(numeroDocumento.value)) {
            numeroDocumento.setCustomValidity('Por favor, ingrese un número de documento válido (5 a 10 dígitos).');
            numeroDocumento.reportValidity(); // Mostrar el mensaje de validación personalizado
            event.preventDefault();  // Evita que el formulario se envíe si la validación falla
        } else {
            numeroDocumento.setCustomValidity(''); // Restablecer la validación si el número es válido
        }
        

            // Validación del archivo de hoja de vida
            const file = inputHojaVida.files[0]; // Obtener el archivo subido

            // Validar que se ha seleccionado un archivo y que sea PDF
            if (file) {
                const fileExtension = file.name.split('.').pop().toLowerCase(); // Obtener la extensión del archivo
                if (fileExtension !== 'pdf') {
                    alert('Por favor, suba un archivo en formato PDF.');
                    event.preventDefault(); // Evitar que el formulario se envíe
                }
            } else {
                alert('Por favor, seleccione un archivo para subir.');
                event.preventDefault(); // Evitar que el formulario se envíe
            }


    });
});
