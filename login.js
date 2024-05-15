// Mock data for user authentication
const users = [
    { username: "user1", password: "password1" },
    { username: "user2", password: "password2" },
    { username: "user3", password: "password3" }
];

// Function to handle form submission
function handleLogin(event) {
    event.preventDefault(); // Prevent form submission

    // Get username and password from the form
    const username = document.getElementById("username").value;
    const password = document.getElementById("password").value;

    // Find user in the users array
    const user = users.find(user => user.username === username && user.password === password);

    // Check if user was found
    if (user) {
        // Redirect to internal homepage (replace 'internal-homepage.html' with your actual homepage URL)
        window.location.href = "internal.html";
    } else {
        // Display error message
        const errorMessage = document.getElementById("error-message");
        errorMessage.textContent = "Usuário ou Senha Inválidos";
    }
}

// Add event listener to the login form
document.getElementById("login-form").addEventListener("submit", handleLogin);
