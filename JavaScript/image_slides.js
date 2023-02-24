var i = 0; // Start point
	var images = [];
	var time = 2500;

	// Image List
	images[0] = './Images/page.jpg';
	images[1] = './Images/show2.jpg';
	images[2] = './Images/page2.jpg';
	images[3] = './Images/page3.jpg';

	// Change Image
	function changeImg(){
		document.slide.src = images[i];

		if(i < images.length - 1){
			i++;
		} else {
			i = 0;
		}

		setTimeout("changeImg()", time);
	}

	window.onload = changeImg;