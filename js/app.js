window.addEventListener('load', function () {
  if(document.getElementById('responsable')){
    let obj = new vanillaSelectBox("#responsable", {
      "search": true,
    })
  }
  for(let i = 1;i < 100;i++) {
    if(document.getElementById('resp' + i)){
      let obj = new vanillaSelectBox("#resp" + i, {
        "search": true,
      })
      let values = document.getElementById('resp' + i).getAttribute('type').toString().split(", ")
      obj.setValue(values)
    }
  }
})
function delete_task(id) {
  if (confirm("Seguro que desea eliminar la tarea " + id + "?")) {
    window.location="https://rifandoencuba.000webhostapp.com/update.php?option=hide&id=" + id;
  } else {
    return
  }
}