<?php

$reservation = $data['reservation'][0];

echo "<h1>Modificar una Reserva</h1>";
echo "<form action = 'index.php' method = 'POST' enctype='multipart/form-data'>
        <input type='hidden' name='id' value='$reservation->id'>
        idRecurso:<input type='text' name='idResource' value='$reservation->idResource'><br>
        idUsuario:<input type='text' name='idUser' value='$reservation->idUser'><br>
        idTimeSlot:<input type='text' name='idTimeSlot' value='$reservation->idTimeSlot'><br>
        Fecha:<input type='calendar' name='date' value='$reservation->date'><br>
        Observaciones:<input type='text' name='remarks' value='$reservation->remarks'><br>";
        
    echo "<input type='hidden' name='action' value='modificar'>
            <input type='hidden' name='controller' value='ReservationController'>
            <input type='submit'>
            </br>
            <p><a href='index.php?controller=ReservationController&action=mostrar'class='btn btn-warning'>Volver</a></p>
    </form>";

?>