/* @version 2.1 fixedMenu
 * @author Lucas Forchino
 * @webSite: http://www.jqueryload.com
 * jquery top fixed menu
 */
(function($){
    $.fn.fixedMenu=function(){
        return this.each(function(){
			var linkClicked= false;
            var menu= $(this);
			$('body').bind('click',function(){
				a = $(this).find('.active').length;
				console.log(a)
					if($(this).find('.active').length>0 && !linkClicked)
					{
						$(this).find('.active').removeClass('active');
					}
					else
					{
						linkClicked = false; 
					}
			});
			
            menu.find('ul li > p').bind('click',function(){
				linkClicked = true;
				if ($(this).parent().hasClass('active')){
					$(this).parent().removeClass('active');
				}
				else{
					$(this).parent().parent().find('.active').removeClass('active');
					$(this).parent().addClass('active');
				}
            })
        });
    }
})(jQuery);