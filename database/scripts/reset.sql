UPDATE stands s SET s.status = 'free', company_id = NULL;
UPDATE EVENTS SET stands_reserved = 0;
DELETE FROM documents;
DELETE FROM companies;
DELETE FROM users;
ALTER TABLE documents AUTO_INCREMENT = 1;
ALTER TABLE companies AUTO_INCREMENT = 1;
ALTER TABLE users AUTO_INCREMENT = 1;