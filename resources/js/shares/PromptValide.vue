<template>
    <div class="bg-black prompt d-flex flex-column align-items-center justify-content-center">
        <img src="/img/svg/send.svg" alt="Post publié avec succèss">
        <h2 class="my-5">Votre post est publié !</h2>
        <router-link class="btn btn-success" :to="{name: 'CardList'}" tag="button">Voir mon post</router-link>
    </div>
</template>

<script>
export default {

}
</script>

<style scoped>
img {
    width: 30vw;
    animation: move 4.5s infinite ease-in;
}

h2 {
    font-size: 2.2rem;
}

.bg-black {
    background-color: rgba(0, 0, 0, 0.822);
}

.btn {
    font-size: 2rem;
}

.prompt {
    position: fixed;
    z-index: 100;
    top: 0;
    left: 0;
    width: 100vw;
    height: 100%;
}

@keyframes move {
    0% {
        opacity: 0;
    }
    49% {
        opacity: 0;
    }
    50% {
        transform: translate(0, 0);
    }
    60% {
        opacity: 1;
        transform: translate(5%, -20%);
    }
    80% {
        transform: translate(30%, -40%);
        filter: blur(2px);
    }
    100% {
        transform: translate(200%, -180%) scale(0.5);
    }
}
</style>