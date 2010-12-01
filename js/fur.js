// WR hates JS this much ---> '-----------------------------------------------------------------------------------------------------------------------------------'

function DisplayOrientationDiv(box,id)
{
	//alert("DisplayOrientationDiv fireing...");
	var elm = document.getElementById(id);
	//elm.style.display = box.checked? "":"none"
	if (box.checked)
	{
		Effect.SlideDown('OrientationDiv');
	}
	else
	{
		Effect.SlideUp('OrientationDiv');
	}
}