<template>
    <div>
        <nav-bar></nav-bar>
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
}

body {
    min-height: 87vh;
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

.align-center {
    text-align: center;
}

.slide-enter-active, .slide-leave-active {
    transition: all 250ms linear;
}

.slide-enter, .slide-leave-to {
    opacity: 0.3;
    transform: scale(1.8);
    filter: blur(7px);
}

.appear-enter-active, .appear-leave-active {
    transition: all 400ms linear;
}

.appear-enter, .appear-leave-to {
    opacity: 0;
}
</style>