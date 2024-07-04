      $(document).ready(function(){
          $(".window-button").click(function(){
                var additionalButtonsContainer = $(this).next(".additional-buttons-container");
                $(".additional-buttons-container").not(additionalButtonsContainer).hide(); // Oculta otros contenedores abiertos
                additionalButtonsContainer.toggle();
            });
            
            $(document).click(function(event) {
                var target = $(event.target);
                if (!target.closest('.window-button').length && !target.closest('.additional-buttons-container').length) {
                    $(".additional-buttons-container").hide();
                }
            });
        });

        $(document).ready(function() {
            $(".ewindow-button").click(function(event) {
                var popup = $("#popup");
                var isVisible = popup.hasClass("show");
        
                // Verificar si el clic fue dentro del botón o en su contenido
                var isInsideButton = $(event.target).closest('.ewindow-button').length > 0;
        
                if (!isVisible && isInsideButton) {
                    popup.addClass("show");
                } else {
                    popup.removeClass("show");
                }
            });
        
            // Cerrar la ventana emergente si se hace clic fuera de ella
            $(document).click(function(event) {
                var target = $(event.target);
                var popup = $("#popup");
        
                // Verificar si el clic no fue dentro de la ventana emergente ni en el botón de abrir la ventana
                if (popup.hasClass("show") && !target.closest('.ewindow-button').length && !target.closest('#popup').length) {
                    popup.removeClass('show');
                }
            });
        });

        $(document).ready(function() {
            $(".awindow-button").click(function(event) {
                // Obtener los valores de los atributos data
                var msgEntidad = $(this).data('msg-entidad');
                var msgOpcion = $(this).data('msg-opcion');
        
                // Actualizar el contenido de la ventana emergente
                $(".msg_entidad_content").html(msgEntidad);
                $(".msg_opcion_content").html(msgOpcion);
        
                var apopup = $("#apopup");
                var isVisible = apopup.hasClass("show");
        
                // Verificar si el clic fue dentro del botón o en su contenido
                var isInsideButton = $(event.target).closest('.awindow-button').length > 0;
        
                if (!isVisible && isInsideButton) {
                    var folio = $(event.target).closest('.awindow-button').data('folio');
                    $("#apopup #folio").val(folio);
        
                    apopup.addClass("show");
                } else {
                    apopup.removeClass("show");
                }
            });
        
            // Cerrar la ventana emergente si se hace clic fuera de ella
            $(document).click(function(event) {
                var target = $(event.target);
                var apopup = $("#apopup");
        
                // Verificar si el clic no fue dentro de la ventana emergente ni en el botón de abrir la ventana
                if (apopup.hasClass("show") && !target.closest('.awindow-button').length && !target.closest('#apopup').length) {
                    apopup.removeClass('show');
                }
            });
        });

        $(document).ready(function() {
            $(".bwindow-button").click(function(event) {
                var bpopup = $("#bpopup");
                var isVisible = bpopup.hasClass("show");
        
                // Verificar si el clic fue dentro del botón o en su contenido
                var isInsideButton = $(event.target).closest('.bwindow-button').length > 0;
        
                if (!isVisible && isInsideButton) {
                    // Obtener el valor del folio del atributo data-folio y asignarlo al input del popup
                    var folio = $(event.target).closest('.bwindow-button').data('folio');
                    $("#bpopup #folio").val(folio);
        
                    bpopup.addClass("show");
                } else {
                    bpopup.removeClass("show");
                }
            });
        
            // Cerrar la ventana emergente si se hace clic fuera de ella
            $(document).click(function(event) {
                var target = $(event.target);
                var bpopup = $("#bpopup");
        
                // Verificar si el clic no fue dentro de la ventana emergente ni en el botón de abrir la ventana
                if (bpopup.hasClass("show") && !target.closest('.bwindow-button').length && !target.closest('#bpopup').length) {
                    bpopup.removeClass('show');
                }
            });
        });

        $(document).ready(function() {
            $(".cwindow-button").click(function(event) {
                var cpopup = $("#cpopup");
                var isVisible = cpopup.hasClass("show");
        
                // Verificar si el clic fue dentro del botón o en su contenido
                var isInsideButton = $(event.target).closest('.cwindow-button').length > 0;
        
                if (!isVisible && isInsideButton) {
                    // Obtener el valor del folio del atributo data-folio y asignarlo al input del popup
                    var folio = $(event.target).closest('.cwindow-button').data('folio');
                    $("#cpopup #folio").val(folio);
        
                    cpopup.addClass("show");
                } else {
                    cpopup.removeClass("show");
                }
            });
        
            // Cerrar la ventana emergente si se hace clic fuera de ella
            $(document).click(function(event) {
                var target = $(event.target);
                var cpopup = $("#cpopup");
        
                // Verificar si el clic no fue dentro de la ventana emergente ni en el botón de abrir la ventana
                if (cpopup.hasClass("show") && !target.closest('.cwindow-button').length && !target.closest('#cpopup').length) {
                    cpopup.removeClass('show');
                }
            });
        });

        function togglePassword() {
            var passwordInput = document.getElementById("password");
            var togglePasswordIcon = document.querySelector(".toggle-password");

            if (passwordInput.type === "password") {
                passwordInput.type = "text";
                togglePasswordIcon.classList.remove("bi-eye-slash");
                togglePasswordIcon.classList.add("bi-eye");
            } else {
                passwordInput.type = "password";
                togglePasswordIcon.classList.remove("bi-eye");
                togglePasswordIcon.classList.add("bi-eye-slash");
            }
        }