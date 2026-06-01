<?php
require_once __DIR__ . '/../Config/api_keys.php';

class BotController {

    public function index() {
        require_once '../app/Views/bot/index.php';
    }

    public function responder() {
    ob_start(); 
    ob_clean(); 
    header('Content-Type: application/json');
    
    $input = json_decode(file_get_contents('php://input'), true);
    $mensaje = isset($input['mensaje']) ? trim($input['mensaje']) : '';
    $historial = isset($input['historial']) ? $input['historial'] : [];

    if (empty($mensaje)) {
        echo json_encode(['respuesta' => 'Por favor escribe un mensaje.']);
        exit();
    }

    $respuesta = $this->llamarOpenRouter($mensaje, $historial);
    echo json_encode(['respuesta' => $respuesta]);
    exit();
}

    private function llamarOpenRouter($mensaje, $historial) {

        $systemPrompt = "Eres GauAuxiliar, el asistente de seguridad de Gaubizi, una aplicación ciudadana para mejorar la seguridad en el ocio nocturno en Euskal Herria.

Tu función es ayudar a los usuarios con:
1. Protocolos de actuación ante incidentes (acoso sexista, sumisión química, discriminación LGTBI/racismo, violencia física)
2. Números de emergencia (112 emergencias, 016 violencia de género, 900 840 111 SOS Racismo Euskadi)
3. Información sobre Puntos Morados en locales de ocio
4. Cómo reportar incidentes en la app Gaubizi
5. Qué es Gaubizi y cómo funciona

Protocolos oficiales:
- Acoso o Agresión Sexista: Busca al personal del local o al Punto Morado más cercano. Llama al 112 en emergencias.
- Sospecha de Sumisión Química: Avisa a tus amistades, no te quedes solo/a, acude a urgencias para análisis toxicológico.
- Discriminación LGTBIfóbica/Racista: Documenta, busca testigos, contacta con SOS Racismo o el observatorio contra la LGTBIfobia.
- Violencia Física o Peleas: Aléjate, no intervengas físicamente, avisa a seguridad del local o llama al 112.

Responde siempre en el mismo idioma que el usuario (euskera, castellano o inglés). Sé empático, claro y conciso. Si el usuario está en peligro inmediato, recuérdale siempre llamar al 112. No respondas preguntas que no estén relacionadas con la seguridad en el ocio nocturno o Gaubizi.";

        $messages = [
            ['role' => 'system', 'content' => $systemPrompt]
        ];

        foreach ($historial as $msg) {
            $messages[] = [
                'role' => $msg['role'] === 'model' ? 'assistant' : $msg['role'],
                'content' => $msg['text']
            ];
        }

        $messages[] = ['role' => 'user', 'content' => $mensaje];

        $data = [
'model' => 'nvidia/nemotron-3-nano-omni-30b-a3b-reasoning:free',
            'messages' => $messages,
            'max_tokens' => 500,
            'temperature' => 0.7
        ];

        $ch = curl_init('https://openrouter.ai/api/v1/chat/completions');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json',
            'Authorization: Bearer ' . OPENROUTER_API_KEY,
            'HTTP-Referer: http://localhost/GaubiziMP',
            'X-Title: GauAuxiliar'
        ]);

        $response = curl_exec($ch);
        curl_close($ch);

        $result = json_decode($response, true);

        if (isset($result['choices'][0]['message']['content'])) {
            return $result['choices'][0]['message']['content'];
        }

        if (isset($result['error'])) {
            return "Error: " . $result['error']['message'];
        }

return "Debug: " . $response;    }
}
?>