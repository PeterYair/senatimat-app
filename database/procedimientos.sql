USE senatimat;

DELIMITER $$
CREATE PROCEDURE spu_estudiantes_listar()
BEGIN
	SELECT EST.idestudiante, EST.apellidos, EST.nombres, EST.tipodocumento, EST.nrodocumento, EST.fechanacimiento,
		ESC.escuela, CAR.carrera, SED.sede, EST.fotografia
		FROM estudiantes EST
		INNER JOIN carreras CAR ON CAR.idcarrera = EST.idcarrera
		INNER JOIN sedes SED ON SED.idsede = EST.idsede
		INNER JOIN escuelas ESC ON ESC.idescuela = CAR.idescuela
		WHERE EST.estado = '1';
END $$

DELIMITER $$
CREATE PROCEDURE spu_estudiantes_registrar
(
	IN _apellidos 			VARCHAR(40),
	IN _nombres 			VARCHAR(40),
	IN _tipodocumento		CHAR(1),
	IN _nrodocumento		CHAR(8),
	IN _fechanacimiento	DATE,
	IN _idcarrera 			INT,
	IN _idsede 				INT,
	IN _fotografia 		VARCHAR(100)
)
BEGIN
	-- Validar el contenido de _fotografia
	IF _fotografia = '' THEN 
		SET _fotografia = NULL;
	END IF;

	INSERT INTO estudiantes 
	(apellidos, nombres, tipodocumento, nrodocumento, fechanacimiento, idcarrera, idsede, fotografia) VALUES
	(_apellidos, _nombres, _tipodocumento, _nrodocumento, _fechanacimiento, _idcarrera, _idsede, _fotografia);
END $$

CALL spu_estudiantes_registrar('Francia Minaya', 'Jhon', 'D', '12345678', '1984-09-20', 5, 1, '');
CALL spu_estudiantes_registrar('Munayco', 'José', 'D', '77779999', '1999-09-20', 3, 2, NULL);
CALL spu_estudiantes_registrar('Prada', 'Teresa', 'C', '01234567', '2002-09-25', 3, 2, '');
SELECT * FROM estudiantes;

DELIMITER $$
CREATE PROCEDURE spu_sedes_listar()
BEGIN
	SELECT * FROM sedes ORDER BY 2;
END $$

DELIMITER $$
CREATE PROCEDURE spu_escuelas_listar()
BEGIN 
	SELECT * FROM escuelas ORDER BY 2;
END $$

DELIMITER $$
CREATE PROCEDURE spu_carreras_listar(IN _idescuela INT)
BEGIN
	SELECT idcarrera, carrera 
		FROM carreras
		WHERE idescuela = _idescuela;
END $$

DELIMITER $$
CREATE PROCEDURE spu_colaboradores_listar()
BEGIN
	SELECT colaboradores.`idcolaborador`, colaboradores.`apellidos`, colaboradores.`nombres`, cargos.`cargo`,
		sedes.sede, colaboradores.`telefono`, tipocontrato,colaboradores.`cv`, colaboradores.`direccion`, colaboradores.`fecharegistro`
		FROM colaboradores
		INNER JOIN cargos ON cargos.`idcargo` = colaboradores.`idsede`
		INNER JOIN sedes  ON sedes.idsede = colaboradores.`idsede` 
		WHERE colaboradores.estado = '1';
END $$

DELIMITER $$
CREATE PROCEDURE spu_colaboradores_registrar
(				
	IN _apellidos 		VARCHAR(40),
	IN _nombres 		VARCHAR(40),
	IN _idcargo			INT,
	IN _idsede			INT,
	IN _telefono		CHAR(9),
	IN _tipocontrato 	CHAR(1),
	IN _cv				VARCHAR(100),
	IN _direccion 		VARCHAR(40)
)
BEGIN
	-- Validar el contenido de _fotografia
	IF _cv = '' THEN 
		SET _cv = NULL;
	END IF;

	INSERT INTO colaboradores 
	(apellidos, nombres, idcargo, idsede, telefono, tipocontrato, cv, direccion) VALUES
	(_apellidos, _nombres, _idcargo, _idsede, _telefono, _tipocontrato, _cv, _direccion);
END $$

DELIMITER $$
CREATE PROCEDURE spu_cargos_listar()
BEGIN
	SELECT * FROM cargos ORDER BY 1;
END $$

DELIMITER $$
CREATE PROCEDURE spu_colaboradores_eliminar(IN _idcolaborador INT)
BEGIN
	DELETE FROM colaboradores 
	WHERE idcolaborador = _idcolaborador;
END $$

DELIMITER $$
CREATE PROCEDURE spu_getNombre(IN _idcolaborador INT)
BEGIN
	SELECT cv FROM colaboradores 
	WHERE idcolaborador = _idcolaborador;
END $$

DELIMITER $$
CREATE PROCEDURE spu_usuarios_login(IN _nombreusuario VARCHAR(30))
BEGIN
	SELECT idusuario, nombreusuario, claveacceso
	FROM usuarios
	WHERE nombreusuario = _nombreusuario AND estado = '1';
END $$

DELIMITER $$
CREATE PROCEDURE spu_estudiantes_eliminar(IN _idestudiante INT)
BEGIN
	UPDATE estudiantes
	SET estado = '0'
	WHERE idestudiante = _idestudiante;
END $$













