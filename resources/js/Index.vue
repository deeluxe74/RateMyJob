<template>
    <div>
        <nav-bar></nav-bar>
        <transition name="appear" mode="out-in">
            <router-view key="1"></router-view>
        </transition>
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

.height-100 {
    min-height: 100vh;
}

.cl-black {
    font-weight: 900;
    color: #131313;
}

.bg-black {
    background-color: #1d1d1d;
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
    transition: all 250ms ease-in;
}

.slide-enter, .slide-leave-to {
    opacity: 0.6;
    transform: scale(1.8);
    filter: blur(3px);
}

.popUp-enter-active, .popUp-leave-active {
    transition: all 1s ease-in;
}

.popUp-enter, .popUp-leave-to {
    transform: translateY(-100vh);
    filter: blur(7px);
}

.appear-enter-active, .appear-leave-active {
    transition: all 400ms linear;
}

.appear-enter, .appear-leave-to {
    opacity: 0;
}

</style>