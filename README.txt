Every time the setup is to be performed, execute the following commands:

php artisan migrate
php artisan storage:link

Caso precise inserir imagens aleatórias:

Não aleatório:
UPDATE shoe
SET image = CASE
    WHEN id % 4 = 0 THEN 'images/shoes/tenisNike1.jpg'
    WHEN id % 4 = 1 THEN 'images/shoes/tenisNike2.png'
    WHEN id % 4 = 2 THEN 'images/shoes/tenisNike3.png'
    WHEN id % 4 = 3 THEN 'images/shoes/tenisNike4.png'
    ELSE image
END

Aleatório:
UPDATE shoe
SET image = CASE 
    WHEN RAND() < 0.25 THEN 'images/shoes/tenisNike1.jpg'
    WHEN RAND() < 0.5 THEN 'images/shoes/tenisNike2.png'
    WHEN RAND() < 0.75 THEN 'images/shoes/tenisNike3.png'
    ELSE 'images/shoes/tenisNike4.png'
END
WHERE id >= 5;


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

