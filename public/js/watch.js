var seen = [];
var seenAlready = JSON.parse(localStorage.getItem('seen'));

// var seenAlready = JSON.parse(localStorage.getItem('seen'));
$('#previous-chap,#next-chap').on('click', function(){
// $(this).css('background-color','grey');
if (typeof(Storage) !== "undefined") {
if(localStorage.getItem('seen') == null)
{
  seen.push($(this).attr('href'));
      localStorage.setItem('seen', JSON.stringify(seen));
}
else{
  var keys = Object.keys(seenAlready);
    keys.forEach(function(key){
        seen.push(seenAlready[key]);
    });
    // console.log(seen);
  if(!seen.includes($(this).attr('href'))){
        seen.push($(this).attr('href'));
        localStorage.setItem('seen', JSON.stringify(seen));
    } 
}
  
}
});
//watch.js

$(document).ready(function(){
      $(window).scroll(function(){
        if($(window).scrollTop() > 300){
          $('#btnScrollTop').css({
            "opacity":"1", "pointer-events":"auto"
          });
        }else{
          $('#btnScrollTop').css({
            "opacity":"0", "pointer-events":"none"
          });
        }
      });
      $('#btnScrollTop').click(function(){
        $('html').animate({scrollTop:0}, 500);
      });
    });

// $(document).ready(function() {
//       var stickyTop = $('.sticky').offset().top;//300

//       $(window).scroll(function() {
//        var windowTop = $(window).scrollTop();//300

//         if (stickyTop < windowTop) {
//           $('.sticky').addClass('sticky-top');
//         } else {
        
//           $('.sticky').removeClass('sticky-top');
//         }
//         });
//       });

if ($('.smart-scroll').length > 0) { // check if element exists
    var last_scroll_top = 0;
     var positionStart = $('.smart-scroll').offset().top;//vị trí của element
    $(window).on('scroll', function() {
        scroll_top = $(this).scrollTop();
        // if(positionStart < scroll_top)
        // {
          
        // }
        if (scroll_top < last_scroll_top && scroll_top >positionStart) {
           $('.smart-scroll').addClass('fixed-top');
           console.log("lên");
        }

        else if(scroll_top <= positionStart ){
            $('.smart-scroll').removeClass('fixed-top');
            console.log("nhỏ hơn bằng")
        }
        else{
           $('.smart-scroll').removeClass('fixed-top');
          console.log("xuống");
        }
        last_scroll_top = scroll_top;

    });
}

 $("#bodyContent,.smart-scroll,.background-show").css("background-color", localStorage.getItem("backgroundColor"));
      $(".content,.title-chap").css("font-size",localStorage.getItem("fontsize")+"px");
      $( ".background-style" ).click(function() {
      var color = $( this ).css( "background-color" );
      
      localStorage.setItem("backgroundColor", color);
      $("#bodyContent,.smart-scroll,.background-show").css("background-color", localStorage.getItem("backgroundColor"));
    });
      
      
      //size
      document.getElementById('size').value= localStorage.getItem("fontsize"); 
      $(".size-show").html(localStorage.getItem("fontsize")+"px");
      $("#size").change(function(){
        var fontSize = $(this).val();
        localStorage.setItem("fontsize", fontSize);
        $(".content,.title-chap").css("font-size",localStorage.getItem("fontsize")+"px");
        $(".size-show").html(localStorage.getItem("fontsize")+"px");
      });
      // end
      // decrease-size
      $( "#decrease-size" ).click(function(e) {
        var fontSize =  parseInt($("#size").val()) - 1;
        localStorage.setItem("fontsize", fontSize);
        $(".content,.title-chap").css("font-size",localStorage.getItem("fontsize")+"px");
        $(".size-show").html(localStorage.getItem("fontsize")+"px");
         document.getElementById('size').value= localStorage.getItem("fontsize"); 
      });
      // end
      // increase-size
      $( "#increase-size" ).click(function(e) {
        var fontSize = parseInt($("#size").val()) + 1;
        localStorage.setItem("fontsize", fontSize);
        $(".content,.title-chap").css("font-size",localStorage.getItem("fontsize")+"px");
        $(".size-show").html(localStorage.getItem("fontsize")+"px");
         document.getElementById('size').value= localStorage.getItem("fontsize"); 
      });

      // line-size

      document.getElementById('line-size').value= localStorage.getItem("linesize"); 
      $(".size-line-show").html(localStorage.getItem("linesize"));
      $("#line-size").change(function(){
        var linesize = $(this).val();
        localStorage.setItem("linesize", linesize);
        $(".content").css("line-height",localStorage.getItem("linesize"));
        $(".size-line-show").html(localStorage.getItem("linesize"));
      });
      // end
      // decrease-size
      $( "#decrease-line-size" ).click(function(e) {
        var linesize = parseFloat($("#line-size").val()) - 0.1;
        localStorage.setItem("linesize", linesize);
        $(".content").css("line-height",localStorage.getItem("linesize"));
        $(".size-line-show").html(localStorage.getItem("linesize"));
        document.getElementById('line-size').value= localStorage.getItem("linesize");  
      });
      // end
      // increase-size
      $( "#increase-line-size" ).click(function(e) {
        var linesize = parseFloat($("#line-size").val()) + 0.1;
        localStorage.setItem("linesize", linesize);
        $(".content").css("line-height",localStorage.getItem("linesize"));
        $(".size-line-show").html(localStorage.getItem("linesize"));
        document.getElementById('line-size').value= localStorage.getItem("linesize");  
      });
$('li.has-mega-menu').each(function(idx, val){  
        var set = 10, //Number of links to display in each column
            buffer = [],
            dropdown = $('.dropdown-menu', this),
            children = dropdown.children(),
            cols = Math.ceil(children.length/set),
            col_class = 'col-6 col-md-' + (cols >= 5 ? '2' : (cols == 4 ? '3' : (cols == 3 ? '4' : 'x'))),
            container_class = 'px-0 container container-' + (cols == 2 ? 'sm' : (cols == 3 ? 'md' : (cols == 4 ? 'lg' : (cols >= 5 ? 'xl' : 'x'))));
            
        for(var i = 0; i < cols; i++) {
            buffer.push('<div class="' + col_class + '">');             
            children.slice(i*set, (i+1)*set).each(function(){
                buffer.push($(this).prop('outerHTML')); 
            });
            buffer.push('</div>');  
        }
        
        dropdown.html('<div class="' + container_class + '"><div class="row">' + buffer.join('\n') + '</div></div>');
});
