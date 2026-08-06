$(function () {
    const revealTargets = $(".hero-panel, .testimonial-card, .contact-panel, .content-panel");

    revealTargets.addClass("reveal").each(function (index) {
        $(this)
            .delay(index * 90)
            .animate({ opacity: 1, top: 0 }, {
                duration: 450,
                step: function (now, fx) {
                    if (fx.prop === "opacity") {
                        const shift = (1 - now) * 10;
                        $(this).css("transform", "translateY(" + shift + "px)");
                    }
                },
                complete: function () {
                    $(this).css("transform", "translateY(0)");
                }
            });
    });
});
