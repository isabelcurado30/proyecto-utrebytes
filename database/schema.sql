CREATE DATABASE IF NOT EXISTS `schema` 
CHARACTER SET utf8mb4 
COLLATE utf8mb4_general_ci; 

USE `schema`; 

-- Tabla: servicios. 
CREATE TABLE IF NOT EXISTS servicios ( 
    id INT AUTO_INCREMENT PRIMARY KEY, 
    nombre VARCHAR (100) NOT NULL, 
    descripcion TEXT NOT NULL, 
    categoria VARCHAR (50), 
    icono VARCHAR (50) 
) ENGINE = InnoDB; 

-- Tabla: solicitudes. 
CREATE TABLE IF NOT EXISTS solicitudes ( 
    id INT AUTO_INCREMENT PRIMARY KEY, 
    servicio_id INT NOT NULL, 
    empresa VARCHAR (100) NOT NULL, 
    email VARCHAR (100) NOT NULL, 
    telefono VARCHAR (20) NOT NULL, 
    descripcion TEXT NOT NULL, 
    prioridad ENUM ('baja', 'media', 'alta') NOT NULL, 
    estado ENUM ('pendiente', 'en_proceso', 'completada') DEFAULT 'pendiente', 
    fecha_solicitud DATETIME DEFAULT CURRENT_TIMESTAMP, 
    CONSTRAINT fk_servicio 
        FOREIGN KEY (servicio_id) 
        REFERENCES servicios (id) 
        ON DELETE CASCADE 
) ENGINE = InnoDB; 

-- Datos de prueba: servicios (5). 
INSERT INTO servicios (nombre, descripcion, categoria, icono) VALUES 
('Desarrollo Web', 'Creación de sitios web corporativos y aplicaciones web a medida.', 'Desarrollo Web', 'web'), 
('Inteligencia Artificial', 'Soluciones de automatización y análisis de datos mediante IA.', 'IA', 'ai'), 
('Ciberseguridad', 'Auditorías de seguridad y protección de sistemas informáticos.', 'Ciberseguridad', 'security'), 
('Cloud Computing', 'Migración y gestión de infraestructuras en la nube.', 'Cloud', 'cloud'), 
('Consultoría IT', 'Asesoramiento tecnológico para optimizar procesos empresariales.', 'Consultoría', 'consulting'); 

-- Datos de prueba: solicitudes (3). 
INSERT INTO solicitudes (servicio_id, empresa, email, telefono, descripcion, prioridad, estado) VALUES 
(1, 'Grupo LRP24', 'info@grupolrp24.com', '600123456', 'Necesitamos una web corporativa moderna y responsive.', 'alta', 'pendiente'), 
(2, 'TechNova', 'contacto@technova.es', '611987654', 'Queremos implementar automatización con inteligencia artificial.', 'media', 'en_proceso'), 
(3, 'SecurePlus', 'soporte@secureplus.com', '622555888', 'Auditoría de seguridad completa de nuestra infraestructura.', 'alta', 'completada');