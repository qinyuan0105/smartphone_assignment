let toastInstance = null;

function showToast() {
    var toastElement = document.getElementById('loginToast');

    // Check if the toast instance already exists
    if (!toastInstance) {
        toastInstance = new bootstrap.Toast(toastElement, {
            autohide: true, // Automatically hide the toast
            delay: 1000     // Delay in milliseconds (1 seconds)
        });

        // Add an event listener to reset the instance when the toast hides
        toastElement.addEventListener('hidden.bs.toast', function () {
            toastInstance = null; // Reset the instance when the toast is hidden
        });
    }

    // Show the toast if it's not already visible
    if (!toastElement.classList.contains('show')) {
        toastInstance.show();
    }
}

