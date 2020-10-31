<template>
    <div class="card-small" v-if="!display" :class="index === 0 ? 'full-margin' : 'mt-3'">
        <div v-if="!load" class="mt-3 frame-illustration">
            <transition name="slide" mode="out-in">
                <img class="illustration" @click="swapPic(index)" v-if="active === index" v-for="(picture, index) in pictures" :src="picture.url" alt="Illustration de la demande" :key="'picture' + index">
            </transition>
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
        <detail-card :card="card" :pictures="pictures"></detail-card>
    </div>
</template>

<script>
import DetailCard from './DetailCard';

export default {
    props: ['card', 'index'],
    components: {
        DetailCard,
    },
    data() {
        return {
            display: false,
            pictures: null,
            load: true,
            active: 0,
        }
    },
    methods: {
        swapPic(index) {
            if(this.pictures.length === 1){
                return;
            }
            else if(index < (this.pictures.length - 1)){
                this.active += 1;
            }else {
                this.active -= 1;
            }
        },
    },
    created(){
        this.load = true;
        axios.post('/api/get/pictures', {
            id: this.card.id
        }).then((response) => {
            this.pictures = response.data.pictures;
        })
        this.load = false;
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
    height: 30vh;
    width: 90vw;
    overflow: hidden;
    transform-origin: bottom;
}

.illustration {
    position: relative;
    top: -10vh;
    min-height: 40vh;
    min-width: 90vw;
}

</style>