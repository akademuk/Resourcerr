$(document).ready(function(){
	$('.slider').slick({
		arrows:true,
		dots:true,
		slidesToShow: 2,
        infinite: false,
		autoplay:false,
		speed:1000,
		autoplaySpeed:800,
		mobileFirst: true,
		responsive: [
			{
			  breakpoint: 1024,
			  settings: {
				slidesToShow: 2,
				slidesToScroll: 1,
				infinite: false,
				dots: true,
			  }
			},
			{
				breakpoint: 900,
				settings: {
				  slidesToShow: 2,
				  slidesToScroll: 1,
				  dots:true,
				}
			  },
			{
				breakpoint: 700,
				settings: {
				  slidesToShow: 1,
				  slidesToScroll: 1,
				  dots:true,
				}
			  },
			{
			  breakpoint: 600,
			  settings: {
				slidesToShow: 1,
				slidesToScroll: 1,
				dots:true,
			  }
			},
			{
			  breakpoint: 480,
			  settings: {
				slidesToShow: 1,
				slidesToScroll: 1,
				dots:true,
			  }
			},
			{
				breakpoint: 180,
				settings: {
				  slidesToShow: 1,
				  slidesToScroll: 1,
				  dots:true,
				  arrows:false,
				}
			  }
		  ]
	});
	$('.slickNavigator').slick({
		slidesToShow: 4,
		mobileFirst: true,
		responsive: [
			{
			  breakpoint: 1024,
			  settings: {
				slidesToShow: 4,
				slidesToScroll: 1,
				infinite: false,
				dots: true,
				arrows:false,
			  }
			},
			{
			  breakpoint: 600,
			  settings: {
				slidesToShow: 2,
				slidesToScroll: 1,
				dots:true,
				arrows:false,
			  }
			},
			{
			  breakpoint: 480,
			  settings: {
				slidesToShow: 1,
				slidesToScroll: 1,
				dots:true,
				arrows:false,
			  }
			},
			{
				breakpoint: 120,
				settings: {
				  slidesToShow: 1,
				  slidesToScroll: 1,
				  dots:true,
				  arrows:false,
				}
			  }
		  ]
		
	});
	$slick_slider = $('.slickNavigator');
settings_slider = {
	responsive: [
		{
		  breakpoint: 1024,
		  settings: {
			slidesToShow: 2,
			slidesToScroll: 1,
			infinite: false,
			dots: true,
			arrows:false,
		  }
		},
		{
		  breakpoint: 600,
		  settings: {
			slidesToShow: 2,
			slidesToScroll: 1,
			dots:true,
			arrows:false,
		  }
		},
		{
		  breakpoint: 480,
		  settings: {
			slidesToShow: 1,
			slidesToScroll: 1,
			dots:true,
			arrows:false,
		  }
		},
		{
			breakpoint: 120,
			settings: {
			  slidesToShow: 1,
			  slidesToScroll: 1,
			  dots:true,
			  arrows:false,
			}
		  }
	  ]
}
slick_on_mobile( $slick_slider, settings_slider);

// slick on mobile
function slick_on_mobile(slider, settings){
  $(window).on('load resize', function() {
	if ($(window).width() > 992) {
	  if (slider.hasClass('slick-initialized')) {
		slider.slick('unslick');
	  }
	  return
	}
	if (!slider.hasClass('slick-initialized')) {
	  return slider.slick(settings);
	}
  });
};
});


// slider
