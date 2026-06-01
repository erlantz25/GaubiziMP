<?php 
$titulo = "GauAuxiliar - Gaubizi";
require_once '../app/Views/layout/header.php'; 
?>

<div class="app-container">

    <!-- Cabecera -->
    <div style="margin-bottom: 24px;">
        <p style="color: #A855F7; font-weight: 600; text-transform: uppercase; font-size: 0.8rem; letter-spacing: 1px;">
            Asistente de Seguridad
        </p>
        <h1 style="font-size: 2rem; font-weight: 800; margin: 6px 0;">GauAuxiliar</h1>
        <p style="color: #94A3B8;">Consulta protocolos de seguridad y resuelve tus dudas sobre el ocio nocturno seguro.</p>
    </div>

    <!-- Ventana de chat -->
    <div id="chat-box" style="background-color: #151A23; border: 1px solid #2A2E39; border-radius: 16px; 
                               padding: 20px; height: 450px; overflow-y: auto; margin-bottom: 16px;
                               display: flex; flex-direction: column; gap: 12px;">
        <!-- Mensaje inicial del bot -->
        <div style="display: flex; gap: 10px; align-items: flex-start;">
            <div style="width: 36px; height: 36px; border-radius: 50%; flex-shrink: 0;
                        background: linear-gradient(135deg, #A855F7, #7C3AED);
                        display: flex; align-items: center; justify-content: center; font-size: 1rem;">
                🤖
            </div>
            <div style="background-color: #1E2532; border-radius: 0 12px 12px 12px; 
                        padding: 12px 16px; max-width: 80%; font-size: 0.9rem; line-height: 1.6;">
                ¡Kaixo! Soy <strong>GauAuxiliar</strong>, el asistente de seguridad de Gaubizi. Puedo ayudarte con protocolos de actuación ante incidentes, números de emergencia y cómo usar la app. ¿En qué puedo ayudarte?
            </div>
        </div>
    </div>

    <!-- Input -->
    <div style="display: flex; gap: 10px;">
        <input type="text" id="chat-input" placeholder="Escribe tu pregunta..." 
               style="flex: 1; background-color: #151A23; border: 1px solid #2A2E39; 
                      border-radius: 50px; padding: 14px 20px; color: #F8FAFC; 
                      font-size: 0.95rem; outline: none; font-family: inherit;"
               onkeypress="if(event.key==='Enter') enviarMensaje()">
        <button onclick="enviarMensaje()" 
                style="background: linear-gradient(135deg, #A855F7, #7C3AED); color: white; 
                       border: none; border-radius: 50px; padding: 14px 24px; 
                       font-weight: 700; cursor: pointer; font-size: 0.95rem; white-space: nowrap;">
            Enviar →
        </button>
    </div>

    <!-- Sugerencias -->
    <div style="margin-top: 16px; display: flex; gap: 8px; flex-wrap: wrap;">
        <button onclick="preguntarSugerencia('¿Qué hago si presencio un acoso?')" 
                style="background-color: #151A23; border: 1px solid #2A2E39; color: #94A3B8; 
                       padding: 8px 14px; border-radius: 50px; font-size: 0.8rem; cursor: pointer;">
            🚨 Acoso
        </button>
        <button onclick="preguntarSugerencia('¿Qué es la sumisión química?')" 
                style="background-color: #151A23; border: 1px solid #2A2E39; color: #94A3B8; 
                       padding: 8px 14px; border-radius: 50px; font-size: 0.8rem; cursor: pointer;">
            💊 Sumisión química
        </button>
        <button onclick="preguntarSugerencia('¿Cuáles son los números de emergencia?')" 
                style="background-color: #151A23; border: 1px solid #2A2E39; color: #94A3B8; 
                       padding: 8px 14px; border-radius: 50px; font-size: 0.8rem; cursor: pointer;">
            📞 Emergencias
        </button>
        <button onclick="preguntarSugerencia('¿Qué es un Punto Morado?')" 
                style="background-color: #151A23; border: 1px solid #2A2E39; color: #94A3B8; 
                       padding: 8px 14px; border-radius: 50px; font-size: 0.8rem; cursor: pointer;">
            🟣 Punto Morado
        </button>
    </div>

</div>

<script>
    let historial = [];

    function enviarMensaje() {
        const input = document.getElementById('chat-input');
        const mensaje = input.value.trim();
        if (!mensaje) return;

        agregarMensaje(mensaje, 'user');
        input.value = '';

        const typingId = agregarTyping();

        fetch('index.php?url=bot-responder', {
    method: 'POST',
    headers: { 'Content-Type': 'application/json' },
    body: JSON.stringify({ mensaje: mensaje, historial: historial })
})
.then(res => res.text())
.then(text => {
    eliminarTyping(typingId);
    try {
        const data = JSON.parse(text);
        agregarMensaje(data.respuesta, 'bot');
        historial.push({ role: 'user', text: mensaje });
        historial.push({ role: 'model', text: data.respuesta });
    } catch(e) {
        agregarMensaje('Error al procesar la respuesta.', 'bot');
    }
})
.catch(() => {
    eliminarTyping(typingId);
    agregarMensaje('Error de conexión. Inténtalo de nuevo.', 'bot');
});
    }

    function preguntarSugerencia(texto) {
        document.getElementById('chat-input').value = texto;
        enviarMensaje();
    }

    function agregarMensaje(texto, tipo) {
        const chatBox = document.getElementById('chat-box');
        const div = document.createElement('div');
        div.style.cssText = 'display: flex; gap: 10px; align-items: flex-start;' + 
                            (tipo === 'user' ? 'flex-direction: row-reverse;' : '');

        const avatar = document.createElement('div');
        avatar.style.cssText = 'width: 36px; height: 36px; border-radius: 50%; flex-shrink: 0; display: flex; align-items: center; justify-content: center; font-size: 1rem;';
        
        if (tipo === 'bot') {
            avatar.style.background = 'linear-gradient(135deg, #A855F7, #7C3AED)';
            avatar.textContent = '🤖';
        } else {
            avatar.style.backgroundColor = '#2A2E39';
            avatar.textContent = '👤';
        }

        const burbuja = document.createElement('div');
        burbuja.style.cssText = 'border-radius: ' + (tipo === 'bot' ? '0 12px 12px 12px' : '12px 0 12px 12px') + 
                                '; padding: 12px 16px; max-width: 80%; font-size: 0.9rem; line-height: 1.6;' +
                                (tipo === 'bot' ? 'background-color: #1E2532;' : 'background-color: rgba(168,85,247,0.15); border: 1px solid rgba(168,85,247,0.3);');
        burbuja.innerHTML = texto;

        div.appendChild(avatar);
        div.appendChild(burbuja);
        chatBox.appendChild(div);
        chatBox.scrollTop = chatBox.scrollHeight;

        return div;
    }

    function agregarTyping() {
        const chatBox = document.getElementById('chat-box');
        const div = document.createElement('div');
        div.style.cssText = 'display: flex; gap: 10px; align-items: flex-start;';
        div.id = 'typing-indicator';

        div.innerHTML = `
            <div style="width:36px;height:36px;border-radius:50%;flex-shrink:0;background:linear-gradient(135deg,#A855F7,#7C3AED);display:flex;align-items:center;justify-content:center;">🤖</div>
            <div style="background-color:#1E2532;border-radius:0 12px 12px 12px;padding:12px 16px;">
                <span style="color:#94A3B8;font-size:0.85rem;">GauAuxiliar está escribiendo...</span>
            </div>`;

        chatBox.appendChild(div);
        chatBox.scrollTop = chatBox.scrollHeight;
        return 'typing-indicator';
    }

    function eliminarTyping(id) {
        const el = document.getElementById(id);
        if (el) el.remove();
    }
</script>

</body>
</html>