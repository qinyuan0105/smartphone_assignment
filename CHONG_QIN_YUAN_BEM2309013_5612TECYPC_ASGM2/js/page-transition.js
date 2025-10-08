document.addEventListener("DOMContentLoaded", () => {
    const body = document.body;

    // Add the transition class on page load
    body.classList.add("page-transition-active");

    // Add a fade-out effect when navigating away
    document.querySelectorAll("a").forEach(link => {
        link.addEventListener("click", (e) => {
            const href = link.getAttribute("href");
            if (href && !href.startsWith("#")) {
                e.preventDefault();
                body.classList.remove("page-transition-active");
                setTimeout(() => {
                    window.location.href = href;
                }, 500); // Match the CSS transition duration
            }
        });
    });
});
