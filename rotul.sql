drop table scoreszx;
create table scoreszx AS
 select *,
case
when edadDias= 0 then 'Nacimiento'
when edadDias= 366 then '1 año'
when LAG(FLOOR(edadDias/365.25)) OVER (ORDER BY edadDias) < FLOOR(edadDias/365.25) then concat(FLOOR(edadDias/365.25),' años')
when LAG(FLOOR(edadDias/30.4375)) OVER (ORDER BY edadDias) < FLOOR(edadDias/30.4375) then FLOOR(edadDias/30.4375) - FLOOR(edadDias/365.25) * 12

else null
end 
 as rotulo



 from scoresZ;

select * from scoreszx;
ALTER TABLE `saltaped_sivin2`.`scoreszx` 
 DROP COLUMN `rotulo4`;
-- DROP COLUMN `Rotulo`;
 drop scoresZ;
ALTER TABLE `saltaped_sivin2`.`scoreszx` 
RENAME TO  `saltaped_sivin2`.`scoresZ` ;
