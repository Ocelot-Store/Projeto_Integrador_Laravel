Every time the setup is to be performed, execute the following commands:

php artisan migrate
php artisan storage:link

Caso precise inserir imagens aleatórias:

Inserts:

INSERT INTO shoe (model, brand_id, user_id, price, size, description, color, image, data_upload, created_at, updated_at)
VALUES 
('Modelo A', 1, 1, 100.00, '1', 'Descrição do Tênis', 'Preto', 'ainda_n_setado', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
('Modelo B', 1, 1, 120.00, '2', 'Descrição do Tênis', 'Preto', 'ainda_n_setado', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
('Modelo C', 1, 1, 150.00, '3', 'Descrição do Tênis', 'Preto', 'ainda_n_setado', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
('Modelo D', 1, 1, 180.00, '4', 'Descrição do Tênis', 'Preto', 'ainda_n_setado', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),

('Modelo A', 1, 1, 100.00, '1', 'Descrição do Tênis', 'Preto', 'ainda_n_setado', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
('Modelo B', 1, 1, 120.00, '2', 'Descrição do Tênis', 'Preto', 'ainda_n_setado', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
('Modelo C', 1, 1, 150.00, '3', 'Descrição do Tênis', 'Preto', 'ainda_n_setado', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
('Modelo D', 1, 1, 180.00, '4', 'Descrição do Tênis', 'Preto', 'ainda_n_setado', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),

('Modelo A', 1, 1, 100.00, '1', 'Descrição do Tênis', 'Preto', 'ainda_n_setado', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
('Modelo B', 1, 1, 120.00, '2', 'Descrição do Tênis', 'Preto', 'ainda_n_setado', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
('Modelo C', 1, 1, 150.00, '3', 'Descrição do Tênis', 'Preto', 'ainda_n_setado', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
('Modelo D', 1, 1, 180.00, '4', 'Descrição do Tênis', 'Preto', 'ainda_n_setado', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),

('Modelo A', 1, 1, 100.00, '1', 'Descrição do Tênis', 'Preto', 'ainda_n_setado', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
('Modelo B', 1, 1, 120.00, '2', 'Descrição do Tênis', 'Preto', 'ainda_n_setado', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
('Modelo C', 1, 1, 150.00, '3', 'Descrição do Tênis', 'Preto', 'ainda_n_setado', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
('Modelo D', 1, 1, 180.00, '4', 'Descrição do Tênis', 'Preto', 'ainda_n_setado', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),

('Modelo A', 1, 1, 100.00, '1', 'Descrição do Tênis', 'Preto', 'ainda_n_setado', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
('Modelo B', 1, 1, 120.00, '2', 'Descrição do Tênis', 'Preto', 'ainda_n_setado', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
('Modelo C', 1, 1, 150.00, '3', 'Descrição do Tênis', 'Preto', 'ainda_n_setado', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
('Modelo D', 1, 1, 180.00, '4', 'Descrição do Tênis', 'Preto', 'ainda_n_setado', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),

('Modelo A', 1, 1, 100.00, '1', 'Descrição do Tênis', 'Preto', 'ainda_n_setado', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
('Modelo B', 1, 1, 120.00, '2', 'Descrição do Tênis', 'Preto', 'ainda_n_setado', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
('Modelo C', 1, 1, 150.00, '3', 'Descrição do Tênis', 'Preto', 'ainda_n_setado', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
('Modelo D', 1, 1, 180.00, '4', 'Descrição do Tênis', 'Preto', 'ainda_n_setado', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);

Atribuindo imagens de forma não aleatória:

UPDATE shoe
SET image = CASE
    WHEN id % 8 = 0 THEN 'images/shoes/tenis1.png'
    WHEN id % 8 = 1 THEN 'images/shoes/tenis2.png'
    WHEN id % 8 = 2 THEN 'images/shoes/tenis3.png'
    WHEN id % 8 = 3 THEN 'images/shoes/tenis4.png'
    WHEN id % 8 = 4 THEN 'images/shoes/tenis5.png'
    WHEN id % 8 = 5 THEN 'images/shoes/tenis6.png'
    WHEN id % 8 = 6 THEN 'images/shoes/tenis7.png'
    WHEN id % 8 = 7 THEN 'images/shoes/tenis8.png'
    ELSE image
END


Atribuindo imagens de forma aleatória:

UPDATE shoe
SET image = CASE 
    WHEN RAND() < 0.125 THEN 'images/shoes/tenis1.png'
	WHEN RAND() < 0.250 THEN 'images/shoes/tenis2.png'
    WHEN RAND() < 0.375 THEN 'images/shoes/tenis3.png'
	WHEN RAND() < 0.500 THEN 'images/shoes/tenis4.png'
	WHEN RAND() < 0.625 THEN 'images/shoes/tenis5.png'
	WHEN RAND() < 0.750 THEN 'images/shoes/tenis6.png'
	WHEN RAND() < 0.875 THEN 'images/shoes/tenis7.png'
    ELSE 'images/shoes/tenis8.png'
END;

