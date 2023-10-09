
{{-- download owl-carousel and integrate link --}}

<div class="owl-carousel">
    <div class="single-clients">
        <img src="/images/partner/15_large.jpg" alt="Japan Bangladesh Friendship Hospital (JBFH)">
    </div>
    <div class="single-clients">
        <img src="/images/partner/16_large.jpg" alt="Australia Bangladesh Comprehensive Cancer Centre">
    </div>
    <div class="single-clients">
        <img src="/images/partner/15_large.jpg" alt="Japan Bangladesh Friendship Hospital (JBFH)">
    </div>
    <div class="single-clients">
        <img src="/images/partner/14_large.jpg" alt="TSR Health Services (Australia) Pty Ltd.">
    </div>
    <div class="owl-item cloned" style="width: 210px; margin-right: 15px;">
        <div class="single-clients">
            <img src="/images/partner/12_large.jpg" alt="Japan Bangladesh Friendship Hospital (JBFH)">
        </div>
    </div>
    <div class="single-clients">
        <img src="/images/partner/14_large.jpg" alt="TSR Health Services (Australia) Pty Ltd.">
    </div>
    <div class="single-clients">
        <img src="/images/partner/12_large.jpg" alt="Japan Bangladesh Friendship Hospital (JBFH)">
    </div>
</div>

<script>
    var owl = $(".owl-carousel");
        owl.owlCarousel({
            loop: true,
            autoplay: true,
            nav: true,
            margin: 10,
            autoplayTimeout: 2000,
            autoplayHoverPause: true,
            responsive: {
                0: {
                    items: 1,
                },
                600: {
                    items: 3,
                },
                960: {
                    items: 5,
                },
                1200: {
                    items: 6,
                },
            },
        });
        owl.on("mousewheel", ".owl-stage", function (e) {
            if (e.deltaY > 0) {
                owl.trigger("next.owl");
            } else {
                owl.trigger("prev.owl");
            }
            e.preventDefault();
        });
</script>