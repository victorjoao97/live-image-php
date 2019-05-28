function del(url, id)
{
  if (confirm("Deseja mesmo apagar?") === true) {
    // if (id.indexOf("jpg") = 0 ) {
    //   window.location = 'http://localhost/selfie/admin/manipulation.php?obj=photo&action=delete&id=' + id;
    // }else{
    window.location = url + id;
  // }
  }
}