var slideIndex = 0;
var slides;
var loopIndexes;

window.addEventListener("load", function(){
    slides = document.getElementsByClassName("mySlides");
    loopIndexes = [];
    for(var i = 0; i < slides.length; i++){
        var indexes = [i];
        if(slides[i].dataset.slideIndex != undefined)
            indexes = parseArray(slides[i].dataset.slideIndex);
        for(var i2 = 0; i2 < indexes.length; i2++){
            loopIndexes[indexes[i2]] = i;
        }
    }
    //alert(loopIndexes);
    showSlides();
})

function parseArray(data){
    var elements = data.split(",");
    var array = [];
    for(var i = 0; i < elements.length; i++){
        array[array.length] = parseInt(elements[i]);
    }
    return array;
}

function showSlides() {
    var i;
    //slides = document.getElementsByClassName("mySlides");
    for (i = 0; i < slides.length; i++) {
        slides[i].style.display = "none";
    }
    //slideIndex++;
    //if (slideIndex> slides.length) {slideIndex = 1} 
    var timeout = 1000;
    var index = loopIndexes[slideIndex];
    slides[index].style.display = "block";
    if(slides[index].dataset.slideTime != undefined)
        timeout = parseInt(slides[index].dataset.slideTime);
    setTimeout(showSlides, timeout); // Change image every 10 seconds
    slideIndex++;
    slideIndex %= loopIndexes.length;
}