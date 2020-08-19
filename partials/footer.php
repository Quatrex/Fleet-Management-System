<div class="footer">
    <div class="copyright">
        <p>Copyright &copy; Designed & Developed by <a href="https://github.com/Quatrex/Fleet-Management-System">Quatrex</a> 2020</p>
    </div>
</div>
<style>
    .rounded {
        border-radius: 0.5rem !important;
    }

    .scroll-to-top {
        z-index: 1042;
        right: 1rem;
        bottom: 1rem;
        display: none;
    }

    .scroll-to-top a {
        width: 3.5rem;
        height: 3.5rem;
        background-color: rgba(33, 37, 41, 0.5);
        line-height: 3.1rem;
        justify-content: center;
        align-items: center;
    }
</style>
<div class="scroll-to-top position-fixed">
    <a class="js-scroll-trigger d-block text-center text-white rounded" href="#page-top"><i class="fa fa-chevron-up"></i></a>
</div>
<script>
    $(document).scroll(function() {
        var scrollDistance = $(this).scrollTop();
        if (scrollDistance > 100) {
            $('.scroll-to-top').fadeIn();
        } else {
            $('.scroll-to-top').fadeOut();
        }
    });
    $('a.js-scroll-trigger[href*="#"]:not([href="#"])').click(function() {
        if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') && location.hostname == this.hostname) {
            var target = $(this.hash);
            target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
            if (target.length) {
                $('html, body').animate({
                    scrollTop: (target.offset().top - 71)
                }, 1000, "easeInOutExpo");
                return false;
            }
        }
    });
</script>