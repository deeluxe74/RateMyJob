<template>
    <div>
        <nav-bar class="height"></nav-bar>
        <router-view></router-view>
    </div>
</template>

<script>
import NavBar from './shares/NavBar';
export default {
    components: {
        NavBar,
    }
}
</script>

<style>
body, html {
    box-sizing: border-box;
    margin: 0;
    padding: 0;
    font-size: 15px;
    color: white;
    font-family: 'Junior', fantasy;
    background-color: #8B0026;
    width: 100vw;
    min-height: 100vh;
}

h2 {
    font-family: 'Hobo Std', fantasy;
    font-size: 1.5rem;
}

h3 {
    font-family: 'Hobo Std', fantasy;
}

h4 {
    font-size: 2rem;
    margin: 0;
}

p {
    font-size: 0.9rem;
    font-family: 'Hobo Std', fantasy;
    margin: 0;
}

.bg-black {
    background-color: #2B2B2B;
}

.bg-pink {
    background-color: #8B0026;
}

.bg-pink-flash {
    background-color: #FF0146;
}

.bg-white {
    background-color: #ffffff;
}

.full-margin {
    margin-top: 13vh;
}
</style>