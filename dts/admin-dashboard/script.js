document.addEventListener('DOMContentLoaded', function () {
	var sidebar = document.getElementById('sidebar');
	var openBtn = document.getElementById('openSidebar');
	var closeBtn = document.getElementById('closeSidebar');
	function openSidebar() { sidebar.classList.add('open'); }
	function closeSidebar() { sidebar.classList.remove('open'); }
	openBtn && openBtn.addEventListener('click', openSidebar);
	closeBtn && closeBtn.addEventListener('click', closeSidebar);
	document.addEventListener('click', function (e) {
		if (!sidebar.classList.contains('open')) return;
		var clickedInside = sidebar.contains(e.target) || (openBtn && openBtn.contains(e.target));
		if (!clickedInside) closeSidebar();
	});
});

