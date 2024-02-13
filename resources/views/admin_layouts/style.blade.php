<style>
    body{
        font-family: "Montserrat", sans-serif;
        background-color: #D9D9D9;
    }
    .sidebar {
        height: 100vh;
        position: fixed;
        top: 0;
        left: 0;
        z-index: 1000;
        background-color: #0F3077;
        width: 250px; /* Fixed width for the sidebar */
        padding-top: 2rem; /* Height of the navbar */
    }
    .sidebar img {
        width: 80%;
        margin: auto;
        display: block;
        margin-bottom: 2rem;
    }
    .sidebar .nav-item {
        border-bottom: 2px solid #4FA7F9;
    }
    .sidebar .nav-link{
        color: #4FA7F9;
    }
    .sidebar .nav-link.active {
        background-color: #5DB6FA;
        color: white;
    }
    .content {
        margin-left: 280px;
        margin-top: 100px;
    }
    .navbar {
        z-index: 999;
        background-color: #5DB6FA;
    }
    table tr:first-child th:first-child {
        border-top-left-radius: 1rem !important;
    }
    table tr:first-child th:last-child {
        border-top-right-radius: 1rem !important;
    }
</style>
