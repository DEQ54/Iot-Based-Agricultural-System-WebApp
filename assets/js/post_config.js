  $('.tab button').on('click', function (e) {
  
  e.preventDefault();
  
  $(this).parent().addClass('active');
  $(this).parent().siblings().removeClass('active');
  
  target = $(this).attr('href');

  $('.tab-content > div').not(target).hide();
  
  $(target).fadeIn(600);
  
});
  $(document).ready(function () {
  $("form").submit(function (event) {
    var formData = {
      soilTemperature: $("#temperature").val(),
      soilMoisture: $("#moisture").val(),
      n: $("#nitrogen").val(),
      p: $("#phosphorus").val(),
      k: $("#potassium").val(),
    };
    
     console.log(formData);

     var url = "http://192.168.4.1/api/postConfig";
     var xhr=new XMLHttpRequest();
     xhr.open("POST",url,true);
     xhr.send(JSON.stringify(formData));

    event.preventDefault();
  });
});