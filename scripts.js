document.addEventListener("DOMContentLoaded", function() {
    const form = document.querySelector(".employee-form");
    form.addEventListener("submit", function(event) {
        const name = document.getElementById("name").value.trim();
        const age = document.getElementById("age").value.trim();
        const department = document.getElementById("department").value.trim();
        const position = document.getElementById("position").value.trim();
        const email = document.getElementById("email").value.trim();
        const phone = document.getElementById("phone").value.trim();

        if (!name || !age || !department || !position || !email || !phone) {
            event.preventDefault();
            alert("All fields are required.");
        }
    });
});
