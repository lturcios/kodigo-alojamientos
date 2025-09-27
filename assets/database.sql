-- Base de datos: alojamientos_app
CREATE DATABASE IF NOT EXISTS alojamientos_app;
USE alojamientos_app;

-- Tabla de usuarios
CREATE TABLE usuarios (
                          id INT AUTO_INCREMENT PRIMARY KEY,
                          nombre VARCHAR(100) NOT NULL,
                          email VARCHAR(100) UNIQUE NOT NULL,
                          password VARCHAR(255) NOT NULL,
                          tipo ENUM('usuario', 'admin') DEFAULT 'usuario',
                          fecha_creacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Tabla de alojamientos
CREATE TABLE alojamientos (
                              id INT AUTO_INCREMENT PRIMARY KEY,
                              nombre VARCHAR(150) NOT NULL,
                              descripcion TEXT,
                              precio DECIMAL(10,2) NOT NULL,
                              ubicacion VARCHAR(200) NOT NULL,
                              imagen VARCHAR(255),
                              fecha_creacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Tabla intermedia para alojamientos seleccionados por usuarios
CREATE TABLE usuario_alojamientos (
                                      id INT AUTO_INCREMENT PRIMARY KEY,
                                      usuario_id INT NOT NULL,
                                      alojamiento_id INT NOT NULL,
                                      fecha_seleccion TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                                      FOREIGN KEY (usuario_id) REFERENCES usuarios(id) ON DELETE CASCADE,
                                      FOREIGN KEY (alojamiento_id) REFERENCES alojamientos(id) ON DELETE CASCADE,
                                      UNIQUE KEY unique_user_accommodation (usuario_id, alojamiento_id)
);

-- Insertar usuario administrador por defecto
INSERT INTO usuarios (nombre, email, password, tipo) VALUES
    ('Administrador', 'admin@admin.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'admin');
-- Password: password

-- Datos de prueba para alojamientos
INSERT INTO alojamientos (nombre, descripcion, precio, ubicacion, imagen) VALUES
                                                                              ('Hotel Plaza Central', 'Elegante hotel en el corazón de la ciudad con todas las comodidades modernas', 120.00, 'Centro Histórico, San Salvador', 'https://images.unsplash.com/photo-1551882547-ff40c63fe5fa?w=800&h=600&fit=crop'),
                                                                              ('Casa Colonial Boutique', 'Encantadora casa colonial restaurada con jardines tropicales', 85.00, 'Antiguo Cuscatlán', 'https://images.unsplash.com/photo-1520250497591-112f2f40a3f4?w=800&h=600&fit=crop'),
                                                                              ('Apartamento Moderno Vista', 'Moderno apartamento con vista panorámica de la ciudad', 95.00, 'Escalón, San Salvador', 'https://images.unsplash.com/photo-1522708323590-d24dbb6b0267?w=800&h=600&fit=crop'),
                                                                              ('Villa Tropical Paradise', 'Villa privada rodeada de naturaleza con piscina', 200.00, 'Playa El Tunco, La Libertad', 'https://images.unsplash.com/photo-1571896349842-33c89424de2d?w=800&h=600&fit=crop'),
                                                                              ('Hostal Surfero', 'Ambiente relajado perfecto para surfistas y mochileros', 25.00, 'Playa El Zonte', 'https://images.unsplash.com/photo-1566073771259-6a8506099945?w=800&h=600&fit=crop'),
                                                                              ('Hotel Business Center', 'Hotel ejecutivo con centro de negocios y wifi gratuito', 110.00, 'San Benito, San Salvador', 'https://images.unsplash.com/photo-1564501049412-61c2a3083791?w=800&h=600&fit=crop');