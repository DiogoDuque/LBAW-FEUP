var points = document.getElementsByClassName('points');

for(var i=0; i < points.length; i++)
{
    if (parseInt(points[i].innerHTML,10) < 0){
        points[i].style.color = 'red';
    }
    else if (parseInt(points[i].innerHTML,10) > 0){
        points[i].style.color = 'green';
    }
}