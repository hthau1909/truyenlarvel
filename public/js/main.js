// readmore content
function AddReadMore() {
        //This limit you can set after how much characters you want to show Read More.
        var carLmt = 80;
        // Text to show when text is collapsed
        var contentDataTxt = " ... xem thêm";
        // Text to show when text is expanded
        var someVeekTxt = " thu gọn";


        //Traverse all selectors with this class and manupulate HTML part to show Read More
        $(".showContentAll").each(function() {
            if ($(this).find(".firstSec").length)
                return;

            var allstr = $(this).text();
            if (allstr.length > carLmt) {
                var firstSet = allstr.substring(0, carLmt);
                var secdHalf = allstr.substring(carLmt, allstr.length);
                var strtoadd = firstSet + "<span class='DspInfo'>" + secdHalf + "</span><span class='contentData'  title='Click to Show More'>" + contentDataTxt + "</span><span class='someVeek' title='Click to Show Less'>" + someVeekTxt + "</span>";
                $(this).html(strtoadd);
            }

        });
        //ReadMore and ReadLess Click Event binding
        $(document).on("click", ".contentData,.someVeek", function() {
            $(this).closest(".showContentAll").toggleClass("displayreadallsome readalldatafull");
        });
    }
    $(function() {
        //Calling function after Page Load
        AddReadMore();
    });
// end
   // mega menu
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


var seen = [];
var seenAlready = JSON.parse(localStorage.getItem('seen'));

$.each(seenAlready,function(index, value){
 $("a[href="+'"'+value+'"'+"]").css('color','#8080806b');
});

$('li').on('click', function(){
// $(this).css('background-color','grey');
if (typeof(Storage) !== "undefined") {
if(localStorage.getItem('seen') == null)
{
  seen.push($(this).find('a').attr('href'));
      localStorage.setItem('seen', JSON.stringify(seen));
}
else{
  var keys = Object.keys(seenAlready);
    keys.forEach(function(key){
        seen.push(seenAlready[key]);
    });
    // console.log(seen);
  if(!seen.includes($(this).find('a').attr('href'))){
        seen.push($(this).find('a').attr('href'));
        localStorage.setItem('seen', JSON.stringify(seen));
    } 
}
  
}
});



