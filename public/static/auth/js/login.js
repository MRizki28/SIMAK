$('#show-password').change(function () {
  if($('#show-password').is(':checked')){
    $('#password').attr('type','text');
  }else{
    $('#password').attr('type','password');
  }
});