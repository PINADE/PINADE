CREATE TABLE filiere (id BIGINT AUTO_INCREMENT, url VARCHAR(255), nom VARCHAR(255), description TEXT, logo VARCHAR(255), PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE promotion (id BIGINT AUTO_INCREMENT, url VARCHAR(255), nom VARCHAR(255), description TEXT, filiere_id BIGINT NOT NULL, conf_trees VARCHAR(255), INDEX filiere_id_idx (filiere_id), PRIMARY KEY(id)) ENGINE = INNODB;
ALTER TABLE promotion ADD CONSTRAINT promotion_filiere_id_filiere_id FOREIGN KEY (filiere_id) REFERENCES filiere(id);
