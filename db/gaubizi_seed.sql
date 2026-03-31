USE gaubizi_db;

INSERT INTO tipos_incidente (nombre, protocolo_actuacion) VALUES
('Acoso o Agresión Sexista', 'Si sufres o presencias acoso, busca al personal del local o al Punto Morado más cercano. Llama al 112 en caso de emergencia inmediata.'),
('Sospecha de Sumisión Química', 'Si notas mareos repentinos, visión borrosa o pérdida de control, avisa a tus amistades de inmediato. No te quedes a solas y acude a urgencias para solicitar un análisis toxicológico.'),
('Discriminación LGTBIfóbica / Racista', 'Tienes derecho a un trato igualitario y seguro. Documenta lo ocurrido si es posible, busca testigos y contacta con el observatorio contra la LGTBIfobia o SOS Racismo de tu zona.'),
('Violencia Física o Peleas', 'Aléjate de la zona de peligro inmediatamente. No intervengas físicamente; avisa a la seguridad del local o a emergencias (112).');

INSERT INTO locales (nombre, direccion, provincia, municipio, latitud, longitud) VALUES
('Sala Sonora', 'Ribera de Axpe 27', 'Bizkaia', 'Erandio', 43.3039, -2.9785),
('Dabadaba', 'Mundaitz Kalea 8', 'Gipuzkoa', 'Donostia-San Sebastián', 43.3168, -1.9763),
('Zentral', 'Mercado de Santo Domingo', 'Nafarroa', 'Iruña-Pamplona', 42.8188, -1.6443),
('Jimmy Jazz', 'Coronación de la Virgen Blanca 4', 'Araba', 'Vitoria-Gasteiz', 42.8505, -2.6749);


INSERT INTO usuarios (nickname, email, password, rol, nivel_confianza) VALUES
('admin_gaubizi', 'admin@gaubizi.eus', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'admin', 100),
('mod_ane', 'ane@gaubizi.eus', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'mod', 80),
('iker_g', 'iker@ejemplo.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'user', 10),
('maite_z', 'maite@ejemplo.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'user', 25);

INSERT INTO denuncias (id_usuario, id_local, id_tipo_incidente, descripcion_privada, estado) VALUES
(NULL, 1, 1, 'Un grupo de chicos no dejaba de molestar a unas chicas en la barra. El personal tardó en actuar.', 'validado'), -- Denuncia anónima (id_usuario = NULL) [cite: 69]
(3, 2, 2, 'Vi cómo alguien intentaba echar algo en un vaso ajeno. Avisé a seguridad y lo echaron.', 'pendiente'),
(4, 3, 3, 'No dejaron entrar a unos amigos por su origen. Trato muy despectivo en puerta.', 'validado');

INSERT INTO resenas (id_usuario, id_local, estrellas, comentario_publico) VALUES
(3, 1, 4, 'Buena música y ambiente, pero los baños estaban un poco oscuros y aislados, daba un poco de inseguridad.'),
(4, 2, 5, 'El personal de puerta fue súper amable y me sentí muy segura toda la noche. Hay carteles de Punto Morado bien visibles.'),
(3, 3, 2, 'Demasiado aforo, casi no se podía respirar. Deberían controlar más el acceso para evitar agobios en caso de emergencia.');

INSERT INTO favoritos (id_usuario, id_local) VALUES
(3, 1),
(3, 2),
(4, 2);

INSERT INTO logs_sistema (id_usuario, accion) VALUES
(1, 'Se validó la denuncia anónima #1 en Sala Sonora');