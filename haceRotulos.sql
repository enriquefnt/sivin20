
UPDATE scoresZ
SET rotulo2 = (
    SELECT rotulo3
    FROM (
        SELECT edadDias, Rotulo, 
               IF(LAG(Rotulo) OVER (ORDER BY edadDias) = Rotulo, NULL, Rotulo) AS rotulo3
        FROM scoresZ
    ) AS subconsulta
    WHERE scoresZ.edadDias = subconsulta.edadDias
);
UPDATE scoresZ
set rotulo2 = null where edadDias = 1; 
UPDATE scoresZ
set rotulo2 = '1 año' where edadDias=366;
select edadDias, Rotulo, rotulo2 from scoresZ