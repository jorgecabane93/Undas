/*
 * @param {type} event
 * @param {type} jsEvent
 * @returns {undefined}
 */
var deleteEvent = function(event, jsEvent) {
    var trashEl = jQuery('#deleteArea');
    var ofs = trashEl.offset();

    var x1 = ofs.left;
    var x2 = ofs.left + trashEl.outerWidth(true);
    var y1 = ofs.top;
    var y2 = ofs.top + trashEl.outerHeight(true);

    if (jsEvent.pageX >= x1 && jsEvent.pageX <= x2 &&
            jsEvent.pageY >= y1 && jsEvent.pageY <= y2) {
        //var confirma = confirm('Seguro que desea eliminar el evento?');
        confirma = true;//fijo para no mostrar confirmacion
        if (confirma) {
            //console.log(event.id);
            $('#calendar').fullCalendar('removeEvents', event._id);
            $.ajax({
                url: 'Include/eliminarEvento.php',
                async: true,
                data: {"idEvento": event.id},
                method: 'POST',
                beforeSend: function() {
                    $('.progress').slideDown();
                },
                success: function(output) {
                    if (output === '1') {
                        $('.progress').slideUp();
                        getCupos();
                    }//si se borro de la base de datos
                }//success
            });//ajax */
        }//si confirma
    }//si se arrojo evento en trashcan
};//deleteEvent