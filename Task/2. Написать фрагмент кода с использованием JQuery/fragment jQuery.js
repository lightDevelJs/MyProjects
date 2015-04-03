//фрагмент кода с использованием JQuery
$( "#mydiv span:last-child" ).find("a").attr("href", 'newurl');

$("#mydiv span a").each(function(){
$(this).not($("span a")[0]).remove();
});

$("#mydiv span a").each(function(){
      $(this).bind('click', click_func);
      function click_func(){ alert('click_func')}
});
