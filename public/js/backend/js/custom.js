$(function() {

    $('#side-menu').metisMenu();

});

//Loads the correct sidebar on window load,
//collapses the sidebar on window resize.
// Sets the min-height of #page-wrapper to window size
$(function() {
    $(window).bind("load resize", function() {
        topOffset = 50;
        width = (this.window.innerWidth > 0) ? this.window.innerWidth : this.screen.width;
        if (width < 768) {
            $('div.navbar-collapse').addClass('collapse');
            topOffset = 100; // 2-row-menu
        } else {
            $('div.navbar-collapse').removeClass('collapse');
        }

        height = ((this.window.innerHeight > 0) ? this.window.innerHeight : this.screen.height) - 1;
        height = height - topOffset;
        if (height < 1) height = 1;
        if (height > topOffset) {
            $("#page-wrapper").css("min-height", (height) + "px");
        }
    });

    var url = window.location;
    var element = $('ul.nav a').filter(function() {
        return this.href == url || url.href.indexOf(this.href) == 0;
    }).addClass('active').parent().parent().addClass('in').parent();
    if (element.is('li')) {
        element.addClass('active');
    }
});


			function getSizes() {
				var tmpSizes = $.parseJSON($('#sizes').val()); 
				var sizes = '<select name="size[]" style="width:200px;">';
				tmpSizes.forEach(function(el) {
					sizes += `<option value="${el.name}">${el.name}</option>`;
				});
				sizes += '</select>';
				return sizes;
			}

			$(document).ready(function(){
			var maxField = 10; //Input fields increment limitation
			var addButton = $('.add_button'); //Add button selector
			var wrapper = $('.field_wrapper'); //Input field wrapper
			var sizes = getSizes();


			var fieldHTML = `
			<div class="field_wrapper">
				<input type="text" name="sku[]" id="sku" placeholder="SKU" width="120px" style="margin-right:5px; margin-top: 10px;"/>
				${sizes}
				<input type="text" name="price[]" id="sku" placeholder="Price" width="120px" style="margin-right:4px;"/>
				<input type="text" name="stock[]" id="sku" placeholder="Stock" width="120px" style="margin-right:5px;" />
				<a href="javascript:void(0);" class="remove_button btn btn-danger btn-sm" title="Remove field">Remove</a>
			</div>`; //New input field html 
			var x = 1; //Initial field counter is 1
			
			//Once add button is clicked
			$(addButton).click(function(){
					//Check maximum number of input fields
					if(x < maxField){ 
							x++; //Increment field counter
							$(wrapper).append(fieldHTML); //Add field html
					}
			});
			
			//Once remove button is clicked
			$(wrapper).on('click', '.remove_button', function(e){
					e.preventDefault();
					$(this).parent('div').remove(); //Remove field html
					x--; //Decrement field counter
			});
	});

