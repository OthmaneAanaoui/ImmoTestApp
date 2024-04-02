<template>
    <div id="app">
      <header>

        <h1></h1>
        <nav>
          <router-link to="/articles" class="nav-link">Liste</router-link>
          <router-link to="/add-article" class="nav-link">Ajouter</router-link>
        </nav>
      </header>
      <main>
        <router-view></router-view>
      </main>
      <footer>
        <p>&copy; 2024 </p>
      </footer>
    </div>
  </template>

  <script>
  export default {
    name: "App",
  };
  </script>

  <style>
  /* Add your global styles here */
  body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
  }

  #app {
    display: flex;
    flex-direction: column;
    min-height: 100vh;
  }

  header {
    background-color: #ca0088;
    color: #fff;
    padding: 1rem;
    text-align: center;
  }

  .logo {
    width: 50px; /* Adjust the width of the logo as needed */
    height: auto; /* Maintain aspect ratio */
    margin-right: 10px; /* Adjust margin as needed */
  }

  nav {
    display: flex;
    justify-content: center; /* Center the navigation links */
    margin-top: 10px; /* Adjust the margin as needed */
  }

  .nav-link {
    color: #fff;
    text-decoration: none;
    margin: 0 10px; /* Adjust the spacing between links */
  }

  .nav-link:hover {
    text-decoration: underline;
  }

  main {
    flex: 1;
    padding: 1rem;
  }

  footer {
    background-color: #ca0088;
    color: #fff;
    text-align: center;
    padding: 0.5rem;
  }
  </style>
