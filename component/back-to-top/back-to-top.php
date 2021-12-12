<link rel="stylesheet" type="text/css" href="./component/back-to-top/back-to-top.css" />
<div id="btt-wrap">
    <button id="back-to-top" onclick="backToTop()">
        <img src="https://img.icons8.com/ios-glyphs/30/000000/chevron-up.png" />
    </button>
</div>
<script>
    function backToTop() {
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
    }

    function scrollFunction2() {
        if (document.body.scrollTop > 300 || document.documentElement.scrollTop > 300) {
            document.getElementById("back-to-top").style.display = "block";
        } else {
            document.getElementById("back-to-top").style.display = "none";
        }
    }
</script>