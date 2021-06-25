let obj_id = null;
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
function delete_task(id, num) {
  if (confirm("Seguro que desea eliminar la tarea " + num + "?")) {
    window.location="https://localhost/SD-PRs/update.php?option=hide&id=" + id;
  } else {
    return
  }
}
function format() {
  let output = document.getElementById('output_format').value;
  let output_obj = document.getElementById('output_format');
  output_obj = null;
  output_obj = output;
}
function show_update(id) {
  this.obj_id = id;
  let edit_area = document.getElementById('edit_area');
  let edit_container = document.getElementById('edit_container');
  edit_container.setAttribute('class', 'container');
  edit_area.value = document.getElementById(id).value;
}
function save() {
  let id = this.obj_id;
  let obj = document.getElementById(id);
  let id_aux = id.replace('url_', '')
  id_aux = id_aux.replace('pr_', '')
  let btn = document.getElementById(id_aux + '_btn_save');
  let edit_area = document.getElementById('edit_area');
  obj.value = edit_area.value;
  let edit_container = document.getElementById('edit_container');
  edit_container.setAttribute('class', 'hidden');
  btn.setAttribute('class', 'btn btn-danger btn-sm');
}
function cancel() {
  let edit_area = document.getElementById('edit_area');
  edit_area.value = '';
  let edit_container = document.getElementById('edit_container');
  edit_container.setAttribute('class', 'hidden');
}
function print() {
  let output_format = document.getElementById('output_format');
  prompt('Output', output_format.value);
}