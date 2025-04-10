<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chatbot Laravel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Chatbot Laravel</h2><input type="text" id="numero_control_alumno" name="numero_control_alumno" value="">
        <div class="chat-box border p-4 mb-4" style="height: 300px; overflow-y: scroll;" id="chat-box">
            <div id="chat"></div>
        </div>
        <form id="chat-form">
            <div class="input-group">
                <input type="text" id="message" class="form-control" placeholder="Escribe un mensaje..." required>
                <button class="btn btn-primary" type="submit">Enviar</button>
                <button class="btn btn-primary" type="button" onclick="javascript:mostrar_contenido_chat();">Contenido casilla chat</button>
            </div>
        </form>
        <div class="chat-box border p-4 mb-4" style="height: 300px; overflow-y: scroll;" id="chat-box2">
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            var mensaje_bienvenida="<br>🙋‍♂️ Hola, soy tu asistente educativo por favor, ingresa tu número de control para poder ayudarte";
            $('#chat').append('<div><strong>Asistente educativo:</strong> ' + mensaje_bienvenida + '</div>');
            $('#chat-form').on('submit', function(e) {
                e.preventDefault();
                
                var message = $('#message').val();
                $('#chat').append('<div><strong>Tú:</strong> ' + message + '</div>');
                $('#message').val('');

                $.ajax({
                    url: '{{ route("chatbot.handle") }}',
                    method: 'POST',
                    data: {
                        message: message,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        $('#chat').append('<div><strong>Asistente educativo:</strong> ' + response.message + '</div>');
                        $('#chat-box').scrollTop($('#chat-box')[0].scrollHeight);
                    }
                });
            });
        });

        function mostrar_contenido_chat()
        {
            // Seleccionamos el div por su id (puedes usar otros selectores según necesites)
            var contenido = document.getElementById('chat-box').innerHTML;
            // Imprimimos el contenido en la consola
            //alert(contenido);
            document.getElementById('chat-box2').innerHTML=contenido;
        }
    </script>
</body>
</html>