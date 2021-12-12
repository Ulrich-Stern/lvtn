<link rel="stylesheet" type="text/css" href="./component/banner/banner.css" />
<div class="slideshow-container">
  <div class="slideshow-inner">
    <div class="mySlides">
      <img src='images/banner1.jpg' style='width: 100%;'/>
    </div>
    <div class="mySlides">
      <img src='images/banner2.jpg' style='width: 100%;'/>
    </div>
    <div class="mySlides">
      <img src='images/banner3.jpg' style='width: 100%;'/>
    </div>
  </div>
  <a class="prev" onclick='plusSlides(-1)'>&#10094;</a>
  <a class="next" onclick='plusSlides(1)'>&#10095;</a>
</div>
<br />
<script>
  var slideIndex = 1;

  var myTimer;

  var slideshowContainer;

  window.addEventListener("load", function() {
    showSlides(slideIndex);
    myTimer = setInterval(function() {
      plusSlides(1)
    }, 2000);

    slideshowContainer = document.getElementsByClassName('slideshow-inner')[0];
  })

  // NEXT AND PREVIOUS CONTROL
  function plusSlides(n) {
    clearInterval(myTimer);
    if (n < 0) {
      showSlides(slideIndex -= 1);
    } else {
      showSlides(slideIndex += 1);
    }

    if (n === -1) {
      myTimer = setInterval(function() {
        plusSlides(n + 2)
      }, 5000);
    } else {
      myTimer = setInterval(function() {
        plusSlides(n + 1)
      }, 5000);
    }
  }

  //Controls the current slide and resets interval if needed
  function currentSlide(n) {
    clearInterval(myTimer);
    myTimer = setInterval(function() {
      plusSlides(n + 1)
    }, 5000);
    showSlides(slideIndex = n);
  }

  function showSlides(n) {
    var i;
    var slides = document.getElementsByClassName("mySlides");
    if (n > slides.length) {
      slideIndex = 1
    }
    if (n < 1) {
      slideIndex = slides.length
    }
    for (i = 0; i < slides.length; i++) {
      slides[i].style.visibility = "hidden";
      slides[i].style.opacity = "0";
    }
    slides[slideIndex - 1].style.visibility = "visible";
    slides[slideIndex - 1].style.opacity = "1";
  }
</script>