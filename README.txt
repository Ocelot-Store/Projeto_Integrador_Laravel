Every time the setup is to be performed, execute the following commands:

php artisan migrate
php artisan storage:link

Caso precise inserir imagens aleatórias:

Não aleatório:

UPDATE shoe
SET image = CASE
    WHEN id % 4 = 0 THEN 'images/shoes/tenisNike1.png'
    WHEN id % 4 = 1 THEN 'images/shoes/tenisNike2.png'
    WHEN id % 4 = 2 THEN 'images/shoes/tenisNike3.png'
    WHEN id % 4 = 3 THEN 'images/shoes/tenisNike4.png'
    ELSE image
END

Aleatório:

UPDATE shoe
SET image = CASE 
    WHEN RAND() < 0.125 THEN 'images/shoes/tenisNike1.png'
	WHEN RAND() < 0.250 THEN 'images/shoes/tenisNike2.png'
    WHEN RAND() < 0.375 THEN 'images/shoes/tenisNike3.png'
	WHEN RAND() < 0.500 THEN 'images/shoes/tenisNike4.png'
	WHEN RAND() < 0.625 THEN 'images/shoes/tenisNike5.png'
	WHEN RAND() < 0.750 THEN 'images/shoes/tenisNike6.png'
	WHEN RAND() < 0.875 THEN 'images/shoes/tenisNike7.png'
    ELSE 'images/shoes/tenisNike8.png'
END;


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

