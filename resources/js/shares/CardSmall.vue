<template>
    <div class="card-small" v-if="!display">
        <div class="mt-3 frame-illustration">
            <img class="illustation" src="/img/svg/exemple.jpg" alt="Illustration de la demande">
        </div>
        <div class="forme bg-black d-flex flex-row justify-content-between align-items-start">
            <div class="d-flex flex-row align-items-center">
                <img src="/img/svg/heart.svg" alt="Nombre de like">
                <div class="ml-1">
                    <h2>{{ card.like }}</h2>
                </div>
            </div>
            <img @click="display = !display" class="vote active hover" src="/img/svg/vote.svg" alt="Voter pour votre choix">
            <div class="d-flex flex-row align-items-center">
                <img src="/img/svg/chat.svg" alt="Nombre de commentaire">
                <div class="ml-1">
                    <h2>{{ card.dislike }}</h2>
                </div>
            </div>
        </div>
    </div>

    <div v-else>
        <detail-card :card="card"></detail-card>
    </div>
</template>

<script>
import DetailCard from './DetailCard';

export default {
    props: ['card'],
    components: {
        DetailCard,
    },
    data() {
        return {
            display: false,
        }
    }
}
</script>

<style scoped>
h2 {
    margin: 0;
}

img {
    width: 2.2rem;
}

.vote {
    width: 3.4rem;
}

.card-small {
    width: 90vw;
}

.forme {
    box-shadow: 9px 8px 15px 0px #000000b7;
    width: 100%;
    height: 8vh;
    border-bottom-left-radius: 200px 120%;
    border-bottom-right-radius: 200px 120%;
    padding: 2% 10%;
}

.frame-illustration {
    box-shadow: 9px 8px 15px 0px #000000b7;
    border-radius: 20px 20px 0 0;
    height: 35vh;
    width: 90vw;
    overflow: hidden;
    transform-origin: bottom;
}

.illustation {
    position: relative;
    top: -10vh;
    width: 90vw;
}


</style>