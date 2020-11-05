<template>
    <transition name="appear" appear>
        <div v-if="!load" class="card-small" :class="[index === 0 ? 'full-margin' : 'mt-3', display ? '' : 'swipe-out']">
            <div class="mt-2 frame-illustration">
                <transition name="slide" mode="out-in">
                    <img class="illustration hover pointer" @click="swapPic(index)" v-if="active === index" v-for="(picture, index) in pictures" :src="picture.url" alt="Illustration de la demande" :key="'picture' + index">
                </transition>
            </div>
            <div class="forme bg-black d-flex flex-row justify-content-between align-items-start">
                <div class="d-flex flex-row align-items-center">
                    <img class="heartbeat" src="/img/svg/heart.svg" alt="Nombre de like">
                    <div class="ml-1">
                        <h2>{{ card.like }}</h2>
                    </div>
                </div>
                <img @click="display = !display" class="vote active hover pointer" src="/img/svg/vote.svg" alt="Voter pour votre choix">
                <div class="d-flex flex-row align-items-center">
                    <img class="jello" src="/img/svg/chat.svg" alt="Nombre de commentaire">
                    <div class="ml-1">
                        <h2>{{ commentsNum }}</h2>
                    </div>
                </div>
            </div>
        </div>
    </transition>
</template>

<script>
import DetailCard from './DetailCard';

export default {
    props: ['card', 'index', 'displaySmall'],
    components: {
        DetailCard,
    },
    data() {
        return {
            display: true,
            pictures: null,
            load: true,
            commentsNum: null,
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
        closeWindow(value) {
            this.display = value;
        },
        getCommentsNum() {
            axios.post('/api/get/commentsNum', {
                id: this.card.id
            }).then((response) => {
                this.commentsNum = response.data.commentsNum;
                this.load = false;
            })
        }
    },
    watch: {
        display(value){
            if(!value){
                setTimeout(() => {
                    this.$emit('displayChange', {
                        card : this.card,
                        pictures : this.pictures,
                    });
                }, 350);
            }
        },
        displaySmall(value){
            if(value){
                this.display = true;
            }
        }
    },
    created(){
        this.load = true;
        axios.post('/api/get/pictures', {
            id: this.card.id
        }).then((response) => {
            this.pictures = response.data.pictures;
        });
        this.getCommentsNum();
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
    transition: all 700ms ease-out;
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
    width: 100%;
    overflow: hidden;
    transform-origin: bottom;
}

.illustration {
    position: relative;
    top: 0vh;
    min-height: 30vh;
    min-width: 100%;
}

.prompt-detail {
    position: absolute;
    z-index: 5;
    top: 0;
    left: 0;
}
</style>