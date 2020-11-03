<template>
    <div class="container-desktop">
        <div class="container-app">
            <nav-bar></nav-bar>
            <transition name="appear" mode="out-in">
                <router-view key="1"></router-view>
            </transition>
        </div>
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
    transition: all 700ms ease-out;
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

.slide-out-in-enter-active, .slide-out-in-leave-active {
    transition: all 600ms ease-out;
}

.slide-out-in-enter {
    transform: translateY(-50vh);
    filter: blur(7px);
}
.slide-out-in-leave-to {
    transform: translateY(50vh);
    filter: blur(7px);
}

.slide-out-in-reverse-enter-active, .slide-out-in-reverse-leave-active {
    transition: all 600ms ease-out;
}
.slide-out-in-reverse-leave-to {
    transform: translateY(-100vh);
    filter: blur(7px);
}
.slide-out-in-reverse-enter {
    transform: translateY(50vh);
    filter: blur(7px);
}

.swipe-out {
    animation: swipe-out 500ms forwards linear;
}
.swipe-in {
    animation: swipe-in 500ms forwards linear;
}

@keyframes swipe-out {
    0% {
        transform: translateY(0vh);
        filter: blur(0px);  
    }
    99% {
        transform: translateY(-100vh);
        filter: blur(7px);
    }
    100% {
        transform: scale(0);
    }
}
@keyframes swipe-in {
    0% {
        transform: translateY(-100vh);
        filter: blur(7px);
        transform: scale(0);  
    }
    1% {
        transform: scale(1);
    }
    100% {
        transform: translateY(0vh);
        filter: blur(0px);
    }
}

/* Media Queries */

@media screen and (min-width: 480px){
    body, html {
        background-color: #520016!important;
    }
    .container-app {
        position: relative;
        width: 480px;
        background-color: #8B0026;
        height: 100%;
        box-shadow: 0px 0px 31px 0px rgba(0,0,0,0.75);
    }

    .container-desktop {
        display: flex;
        justify-content: center;
        background-color: #520016;
        width: 100vw;
        height: 100vh;
    }

    .card-small {
        width: 400px!important;
    }

    .talk {
        width: 480px!important;
    }

    .circle {
        width: 55px!important;
        height: 55px!important;
    }

    .bloc-post {
        width: 480px;
    }
}
</style>