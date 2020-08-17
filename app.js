const hamburger = document.querySelector('.header .nav-bar .nav-list .hamburger');
const mobile_menu = document.querySelector('.header .nav-bar .nav-list ul');
const menu_item = document.querySelectorAll('.header .nav-bar .nav-list ul li a');
const header = document.querySelector('.header.container');

hamburger.addEventListener('click', () => {
	hamburger.classList.toggle('active');
	mobile_menu.classList.toggle('active');
});

document.addEventListener('scroll', () => {
	var scroll_position = window.scrollY;
	if (scroll_position > 500) {
		header.style.backgroundColor = '#29323c';
	} else {
		header.style.backgroundColor = 'transparent';
	}
});

menu_item.forEach((item) => {
	item.addEventListener('click', () => {
		hamburger.classList.toggle('active');
		mobile_menu.classList.toggle('active');
	});
});
<<<<<<< HEAD

function scrollappear(){
	var sectiontitle1 = document.querySelector('.section-title1');
	var sectionposition = sectiontitle1.getBoundingClientRect().top;
	var screenposition = window.innerHeight / 1.2

	if(sectionposition < screenposition){
		sectiontitle1.classList.add('section1-appear')
		
	}

}
	window.addEventListener('scroll', scrollappear);
=======
>>>>>>> d4bdfdbc1e91615af05bbc13fe41e9e81f62445b
