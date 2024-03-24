select edadDias, Rotulo, rotulo2, FLOOR(edadDias/30.44)  as rotulo3  , LAG(FLOOR(edadDias/30.44)) OVER (ORDER BY edadDias) as anterior,
/* case
when edadDias= 0 then 'Nacimiento'
when edadDias= 366 then '1 año'
when LAG(FLOOR(edadDias/365.242)) OVER (ORDER BY edadDias) < FLOOR(edadDias/365.242) then concat(FLOOR(edadDias/365.242),' años')
when LAG(FLOOR(edadDias/30.4167)) OVER (ORDER BY edadDias) < FLOOR(edadDias/30.4167) then FLOOR(edadDias/30.4167) - FLOOR(edadDias/365.242) * 12

else null
end 
as rotulo4 */
case
when edadDias= 0 then 'Nacimiento'
when edadDias= 366 then '1 año'
when LAG(FLOOR(edadDias/365.25)) OVER (ORDER BY edadDias) < FLOOR(edadDias/365.25) then concat(FLOOR(edadDias/365.25),' años')
when LAG(FLOOR(edadDias/30.44)) OVER (ORDER BY edadDias) < FLOOR(edadDias/30.44) then FLOOR(edadDias/30.44) - FLOOR(edadDias/365.25) * 12

else null
end 
as rotulo4



from scoresZ
