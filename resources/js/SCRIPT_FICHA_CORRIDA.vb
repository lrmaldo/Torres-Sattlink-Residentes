:local tiempo [ /system clock get time ]
:local tiempoHora [:pick $tiempo 0 2]
:local tiempoMinutos [:pick $tiempo 3 5]
:local tiempoSegundos [:pick $tiempo 6 9]
:local tiempoActual ($tiempoHora.":".$tiempoMinutos.":".$tiempoSegundos)

:local fecha [ /system clock get date ]
:local fechaAnio [:pick $fecha 7 11]
:local fechaMes [:pick $fecha 0 3]
:local fechaDia [:pick $fecha 4 6]
:local fechaActual ($fechaDia."/".$fechaMes."/".$fechaAnio)

:local dias 7 # cambiar dias de duracion del plan
:local horas 0 # cambiar horas de duracion del plan
:local minutos 0 $ cambiar minutos de duracion del plan
:local nombrePlan  [ /ip hotspot user get $user profile ]

:local meses ("jan","feb","mar","apr","may","jun","jul","aug","sep","oct","nov","dec")
:if (($fechaAnio * 4) / 4 = $fechaAnio) do={
    :local mesesDias ("31","29","31","30","31","30","31","31","30","31","30","31")
} else={
    :local mesesDias ("31","28","31","30","31","30","31","31","30","31","30","31")
}

:local mesNumero ([:find $meses $fechaMes])
:local diaMes ([:pick $mesesDias $mesNumero])

:set fechaDia ($fechaDia + $dias)
:set tiempoHora ($tiempoHora + $horas)
:set tiempoMinutos ($tiempoMinutos + $minutos)

:if ($tiempoMinutos > 59) do={
    :set tiempoMinutos ($tiempoMinutos - 60)
    :set tiempoHora ($tiempoHora + 1)
}

:if ($tiempoHora > 23) do={
    :set tiempoHora ($tiempoHora - 24)
    :set fechaDia ($fechaDia + 1)
}

:if ($fechaDia > $diaMes) do={
    :set fechaDia ($fechaDia - $diaMes)
    :set mesNumero ($mesNumero + 1)
}

:if ($mesNumero > 11) do={
    :set mesNumero ($mesNumero - 12)
    :set fechaAnio ($fechaAnio + 1)
}

:set fechaMes ([:pick $meses $mesNumero])

:if ($tiempoMinutos < 10) do={
    :set tiempoMinutos ("0".$tiempoMinutos)
}
:if ($tiempoHora < 10) do={
    :set tiempoHora ("0".$tiempoHora)
}

:set tiempo ($tiempoHora.":".$tiempoMinutos.":".$tiempoSegundos)

:set fecha ($fechaDia."/".$fechaMes."/".$fechaAnio)

:system scheduler add name=$user interval=10 on-event="\
    /ip hotspot user remove [/ip hotspot user find name=$user];\
    /ip hotspot active remove [/ip hotspot active find user=$user];\
    /system scheduler remove [/system scheduler find name=$user];\
" start-date=$fecha start-time=$tiempo

:local comentario ("Periodo: ".$fechaActual." - ".$tiempoActual." a ".$fechaDia."/".$fechaMes."/".$fechaAnio." - ".$tiempo)

:if ([ /ip hotspot user get $user comment ] = "") do={
    /ip hotspot user set $user comment=$comentario
}

:log warning "Usuario= $user $comentario Plan= $nombrePlan"
