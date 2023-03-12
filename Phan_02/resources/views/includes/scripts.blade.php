<script src="{{ asset('assets/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script>
    let url = window.location.origin + window.location.pathname;
    document.querySelectorAll('a').forEach((item) => {
        if (item.href === url) {
            item.classList.add("active");
        }
    });
</script>
