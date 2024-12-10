use alpha;

DELIMITER $$

CREATE PROCEDURE sp_insert_padre(
    IN nombre VARCHAR(255),
    IN apellido VARCHAR(255),
    IN dni VARCHAR(8),
    IN id_padre INT
)
BEGIN
    DECLARE email VARCHAR(255);
    DECLARE contra_hash VARCHAR(255);
    DECLARE user_id INT;

    SET email = CONCAT(LEFT(REPLACE(LOWER(nombre), ' ', ''),2),
                   REPLACE(LOWER(apellido), ' ', ''), 
                   LEFT(dni, 3), 
                   '@gmail.com');
    SET contra_hash = MD5(dni);
    
    INSERT INTO users (name, email, password, rol, created_at, updated_at)
    VALUES (nombre, email, contra_hash, 'padre_familia', null, null);

    SET user_id = LAST_INSERT_ID();

    UPDATE padres_familia SET id = user_id WHERE id_padre_familia = id_padre;
END$$

DELIMITER ;



DELIMITER $$
CREATE PROCEDURE sp_insert_profesor(
    IN nombre VARCHAR(255),
    IN apellido VARCHAR(255),
    IN dni VARCHAR(8),
    IN id_profe INT
)
BEGIN
    DECLARE email VARCHAR(255);
    DECLARE contra_hash VARCHAR(255);
    DECLARE id INT;

    SET email = CONCAT(LEFT(REPLACE(LOWER(nombre), ' ', ''),2),
                   REPLACE(LOWER(apellido), ' ', ''), 
                   LEFT(dni, 3), 
                   '@gmail.com');
    SET contra_hash = MD5(dni);
    
    INSERT INTO users (name, email, password, rol, created_at, updated_at)
    VALUES (nombre, email, contra_hash, 'profesor', null, null);

    SET id = LAST_INSERT_ID();

    UPDATE profesores SET user_id = id WHERE id_profesor = id_profe;
END$$

DELIMITER ;





