Select NotId AS IdNoti, DATE_FORMAT(NotFecha , "%d/%m/%Y") AS Fecha, NotFecha AS Ordena,
ApeNom As Nombre, ApeResp AS Responsable,ResiDire as Domicilio,
@tabla:="Notificación" AS Tipo, Ao_Nom AS AOP,IdNinio,
 ROUND(NotPeso,2) AS Peso, NotTalla AS Talla,
 ROUND(NotZpe,2) AS ZPesoEdad ,ROUND(NotZta,2) 
 AS ZTallaEdad ,ROUND(NotZimc,2) AS ZIMCEdad ,
IF (NotFecha <> "31/12/25",floor(DATEDIFF(NotFecha, FechaNto)/365.25),floor(DATEDIFF(CURDATE(), FechaNto)/365.25))  AS años,
IF (NotFecha <> "31/12/25",floor((DATEDIFF(NotFecha, FechaNto)%365.25)/30.4375),floor((DATEDIFF(CURDATE(), FechaNto)%365.25)/30.4375))  AS meses,
IF (NotFecha <> "31/12/25",floor(datediff(NotFecha, FechaNto) % 30.4375),floor(datediff(CURDATE(),FechaNto) % 30.4375))  AS dias,


IF (NotFecha <> "31/12/25",floor(DATEDIFF(CURDATE(), FechaNto)/365.25),floor(DATEDIFF(CURDATE(), FechaNto)/365.25))  AS añosr,
IF (NotFecha <> "31/12/25",floor((DATEDIFF(CURDATE(), FechaNto)%365.25)/30.4375),floor((DATEDIFF(CURDATE(), FechaNto)%365.25)/30.4375))  AS mesesr,
IF (NotFecha <> "31/12/25",floor(datediff(CURDATE(), FechaNto) % 30.4375),floor(datediff(CURDATE(),FechaNto) % 30.4375))  AS diasr,
CASE
    WHEN  
    (NotZpe > 7 OR NotZimc > 7 OR NotZta > 7 OR 
			NotZpe < -7 OR NotZimc < -7 OR NotZta < -7) 
        THEN "Medida erronea"  
	WHEN NotZimc <-3  AND NotZta <= -2 AND (NotClinica <> 2  OR MotId <> 3)
        THEN "Crónico Agudizado Severo"  
		
	WHEN (NotZimc >-3 AND NotZimc <=-2)   AND NotZta <= -2 AND (NotClinica <> 2  OR MotId <> 3)
        THEN "Crónico Agudizado Moderado"  		
    WHEN 
    	NotZimc <=-3 OR NotClinica= 2  OR MotId = 3 
        THEN "Agudo Severo"
    WHEN 
    	(NotZimc >-3 AND NotZimc <=-2)   
        THEN "Agudo Moderado"
    WHEN 
		NotZpe < -2 AND NotZimc > -2 AND NotZta > -2 
        THEN "Ver curva"
      
    WHEN (NotZimc >-2  OR NotEvo = 2 )  AND NotZta <= -2 
        THEN "Crónico"
	WHEN  NotMotivo = 2 AND  NotZpe > -2 
        THEN "Curva anormal"
	WHEN  NotZpe > -2 AND NotZimc >-2 AND NotZta >-2
        THEN "Sin déficit"
     
            
END
 AS Clacificación,
CASE
	WHEN  TIMESTAMPDIFF(DAY, NotFecha, now()) < 30
    THEN "1FFA0480"
	WHEN TIMESTAMPDIFF(DAY, NotFecha, now()) >= 30 AND TIMESTAMPDIFF(DAY, NotFecha, now()) <= 60
    THEN "FFFA0A80"
	WHEN TIMESTAMPDIFF(DAY, NotFecha, now()) >60
    THEN "FA180480"  
END 
AS color

from NOTIFICACION
left join NOTICONTROL on NotId=IdNoti
inner join NIÑOS on NotNinio=IdNinio
inner join AREAS on Aoresi=Ao_Id
right join NIÑORESIDENCIA on IdNinio =ResiNinio
left join MOTIVOSNOTI on NotMotivo = MotId
 where 
-- Aoresi= aope AND 
 NotFin="NO" 
 --  
 AND IdCtrol IS null

UNION
select t.IdNoti, DATE_FORMAT(t.CtrolFecha , "%d/%m/%Y") AS Fecha, @ordena:=CtrolFecha,
ApeNom As Nombre, ApeResp AS Responsable,ResiDire as Domicilio,
@tabla:="Control" AS Tipo, Ao_Nom AS AOP,IdNinio,
ROUND(t.CtrolPeso,2) AS Peso,
	CtrolTalla AS Talla, ROUND(t.CtrolZp,2) AS ZPesoEdad ,ROUND(t.CtrolZt,2)  AS ZTallaEdad , 
    ROUND(t.CtrolZimc,2) AS ZIMCEdad ,
 



IF (t.CtrolFecha <> "31/12/25",floor(DATEDIFF(t.CtrolFecha, FechaNto)/365.25),floor(DATEDIFF(CURDATE(), FechaNto)/365.25))  AS años,
IF (t.CtrolFecha <> "31/12/25",floor((DATEDIFF(t.CtrolFecha, FechaNto)%365.25)/30.4375),floor((DATEDIFF(CURDATE(), FechaNto)%365.25)/30.4375))  AS meses,
IF (t.CtrolFecha <> "31/12/25",floor(datediff(t.CtrolFecha, FechaNto) % 30.4375),floor(datediff(CURDATE(),FechaNto) % 30.4375))  AS dias,

IF (t.CtrolFecha <> "31/12/25",floor(DATEDIFF(CURDATE(), FechaNto)/365.25),floor(DATEDIFF(CURDATE(), FechaNto)/365.25))  AS añosr,
IF (t.CtrolFecha <> "31/12/25",floor((DATEDIFF(CURDATE(), FechaNto)%365.25)/30.4375),floor((DATEDIFF(CURDATE(), FechaNto)%365.25)/30.4375))  AS mesesr,
IF (t.CtrolFecha <> "31/12/25",floor(datediff(CURDATE(), FechaNto) % 30.4375),floor(datediff(CURDATE(),FechaNto) % 30.4375))  AS diasr,
				 CASE
				    WHEN  
    CtrolZp > 7 OR CtrolZimc > 7 OR CtrolZt > 7 OR
			CtrolZp < -7 OR CtrolZimc < -7 OR CtrolZt < -7
        THEN "Medida erronea"  
	WHEN CtrolZimc <-3  AND CtrolZt <= -2 AND CtrolClinica <> 2
        THEN "Crónico Agudizado Severo"  
		
	WHEN (CtrolZimc >-3 AND CtrolZimc <=-2)   AND CtrolZt <= -2 
        THEN "Crónico Agudizado Moderado"  		
    WHEN 
    CtrolZimc <-3 OR  CtrolClinica = 2
        THEN "Agudo Severo"
    WHEN 
    	(CtrolZimc >-3 AND CtrolZimc <=-2)   
        THEN "Agudo Moderado"
    WHEN 
  		CtrolZp < -2 AND CtrolZimc > -2 AND CtrolZt > -2 
        THEN "Ver curva"
    WHEN (CtrolZimc >-2  OR NotEvo = 2 )  AND CtrolZt <= -2 
        THEN "Crónico"
	WHEN  NotMotivo = 2 
        THEN "Curva anormal"
	WHEN  CtrolZp > -2 AND CtrolZimc >-2 AND CtrolZt >-2
        THEN "Sin déficit"
     
        
END 
AS Clacificación,
CASE
	WHEN  TIMESTAMPDIFF(DAY,CtrolFecha , now()) < 30
    THEN "1FFA0480"
	WHEN TIMESTAMPDIFF(DAY, CtrolFecha, now()) >= 30 AND TIMESTAMPDIFF(DAY, CtrolFecha, now()) <= 60
    THEN "FFFA0A80"
	WHEN TIMESTAMPDIFF(DAY, CtrolFecha, now()) >60
    THEN "FA180480"
    
END 
AS color

from NOTICONTROL t
inner join NOTIFICACION on IdNoti=NotId
inner join NIÑOS on NotNinio=IdNinio
 inner join (select IdNoti, max(CtrolFecha) as MaxdateCtrl
				  from NOTICONTROL
				  group by IdNoti)
                  tm on t.IdNoti= tm.IdNoti and t.CtrolFecha = tm.MaxDateCtrl 
inner join AREAS on Aoresi=Ao_Id
inner join NIÑORESIDENCIA on IdNinio =ResiNinio
inner join MOTIVOSNOTI on NotMotivo = MotId
where 
                                -- Aoresi= aope AND 
                                NotFin="NO" 
                               GROUP BY ApeNom
                            order by Ordena desc;
