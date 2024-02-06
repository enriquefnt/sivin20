DROP TABLE if exists UsuariosExport;
CREATE TABLE UsuariosExport
-- UPDATE MSP_NUTRICION.USUARIOS
-- SET idEfector = CASE WHEN idEfector = 0 THEN 522 ELSE idEfector END;
SELECT 
 Idusuario, IdAo, 
IdEfector, Ape, Nom, Dni, 
Cargo, TipoUsu, Profesion, 
 NomUsuario, Contraseña, Mail, Baja, eMailok,
 Auditor, 
 CerrarNoti, Usu_Contra, 
 Est_Id, Est_Area, 
 Est_Nom, 

CASE
    WHEN Cargo like "%admin%" THEN "Administrativo"
    WHEN  Auditor="NO" THEN "Vigilante"
     WHEN Auditor="SI" THEN "Auditor"
    else "Otro"
    END
    AS Tipo,
CASE
WHEN Profesion like "%ADMIN%" THEN "Administrativo"
WHEN Profesion like "%sanita%" THEN "Agente Sanitario"
WHEN Profesion like "%enfer%" THEN "Enfermería"
WHEN Profesion like "%nutri%" THEN "Nutrición"
WHEN Profesion like "%medi%" THEN "Medicina"
else "Otro"
END
AS Profe






    


FROM MSP_NUTRICION.USUARIOS
inner join ESTABLECIMIENTOS on IdEfector=Est_Id
left join AREAS on idAo=Ao_Id;

select * from UsuariosExport
order by Auditor;