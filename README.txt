Every time the setup is to be performed, execute the following commands:

php artisan migrate
php artisan storage:link

Caso precise inserir imagens aleatórias:

UPDATE shoe
SET image = CASE
    WHEN id % 4 = 0 THEN 'images/shoes/tenisNike1.jpg'
    WHEN id % 4 = 1 THEN 'images/shoes/tenisNike2.png'
    WHEN id % 4 = 2 THEN 'images/shoes/tenisNike3.png'
    WHEN id % 4 = 3 THEN 'images/shoes/tenisNike4.png'
    ELSE image
END

Inserts:

INSERT INTO shoe (model, brand_id, user_id, price, size, description, color, image, data_upload, created_at, updated_at)
VALUES 
('Modelo A', 1, 1, 100.00, '42', 'Descrição do Tênis', 'Preto', 'ainda_n_setado', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
('Modelo B', 1, 1, 120.00, '42', 'Descrição do Tênis', 'Preto', 'ainda_n_setado', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
('Modelo C', 1, 1, 150.00, '42', 'Descrição do Tênis', 'Preto', 'ainda_n_setado', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
('Modelo D', 1, 1, 180.00, '42', 'Descrição do Tênis', 'Preto', 'ainda_n_setado', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),

('Modelo A', 1, 1, 100.00, '42', 'Descrição do Tênis', 'Preto', 'ainda_n_setado', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
('Modelo B', 1, 1, 120.00, '42', 'Descrição do Tênis', 'Preto', 'ainda_n_setado', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
('Modelo C', 1, 1, 150.00, '42', 'Descrição do Tênis', 'Preto', 'ainda_n_setado', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
('Modelo D', 1, 1, 180.00, '42', 'Descrição do Tênis', 'Preto', 'ainda_n_setado', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),

('Modelo A', 1, 1, 100.00, '42', 'Descrição do Tênis', 'Preto', 'ainda_n_setado', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
('Modelo B', 1, 1, 120.00, '42', 'Descrição do Tênis', 'Preto', 'ainda_n_setado', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
('Modelo C', 1, 1, 150.00, '42', 'Descrição do Tênis', 'Preto', 'ainda_n_setado', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
('Modelo D', 1, 1, 180.00, '42', 'Descrição do Tênis', 'Preto', 'ainda_n_setado', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),

('Modelo A', 1, 1, 100.00, '42', 'Descrição do Tênis', 'Preto', 'ainda_n_setado', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
('Modelo B', 1, 1, 120.00, '42', 'Descrição do Tênis', 'Preto', 'ainda_n_setado', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
('Modelo C', 1, 1, 150.00, '42', 'Descrição do Tênis', 'Preto', 'ainda_n_setado', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
('Modelo D', 1, 1, 180.00, '42', 'Descrição do Tênis', 'Preto', 'ainda_n_setado', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),

('Modelo A', 1, 1, 100.00, '42', 'Descrição do Tênis', 'Preto', 'ainda_n_setado', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
('Modelo B', 1, 1, 120.00, '42', 'Descrição do Tênis', 'Preto', 'ainda_n_setado', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
('Modelo C', 1, 1, 150.00, '42', 'Descrição do Tênis', 'Preto', 'ainda_n_setado', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
('Modelo D', 1, 1, 180.00, '42', 'Descrição do Tênis', 'Preto', 'ainda_n_setado', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),

('Modelo A', 1, 1, 100.00, '42', 'Descrição do Tênis', 'Preto', 'ainda_n_setado', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
('Modelo B', 1, 1, 120.00, '42', 'Descrição do Tênis', 'Preto', 'ainda_n_setado', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
('Modelo C', 1, 1, 150.00, '42', 'Descrição do Tênis', 'Preto', 'ainda_n_setado', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
('Modelo D', 1, 1, 180.00, '42', 'Descrição do Tênis', 'Preto', 'ainda_n_setado', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);

