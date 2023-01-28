/**
 * Funciones auxiliares de javascripts 
 */
function confirmarBorrar(nombre,id){
  if (confirm("¿Quieres eliminar el cliente:  "+nombre+"?"))
  {
   document.location.href="?orden=Borrar&id="+id;
  }
}

function borrarImg(imagen) {
  var output = document.getElementById('fotografia');
      output.src = imagen;
      output.onload = function() {
        URL.revokeObjectURL(output.src);
      }
  document.getElementById('foto').value = "";
  document.getElementById("borrar").disabled = true;
}

