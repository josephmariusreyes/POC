import $ from 'jquery';

window.$ = $;
window.jQuery = $;

$(function () {
	// Toggle the mobile navigation so the layout stays usable on small screens.
	$('[data-nav-toggle]').on('click', function () {
		$('[data-nav-menu]').slideToggle(200);
	});

	// Add a simple interactive highlight on the vehicle cards.
	$('[data-vehicle-card]').on('mouseenter', function () {
		$(this).addClass('is-active');
	}).on('mouseleave', function () {
		$(this).removeClass('is-active');
	});

	// Mirror message length so you can see how much text is left in the inquiry form.
	$('[data-message-input]').on('input', function () {
		const currentLength = $(this).val().length;
		$('[data-message-count]').text(currentLength);
	}).trigger('input');
});
